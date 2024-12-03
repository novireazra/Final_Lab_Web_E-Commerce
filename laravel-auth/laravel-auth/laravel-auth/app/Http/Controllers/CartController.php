<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with(['user', 'menu'])->latest()->get();
        return view('carts.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $menus = Menu::all();
        return view('carts.create', compact('users', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_menu' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
            'sub_total' => 'required|numeric|min:0',
        ]);

        Cart::create($request->all());

        return redirect()->route('carts.index')->with('success', 'Cart item added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cart = Cart::findOrFail($id);
        $users = User::all();
        $menus = Menu::all();
        return view('carts.edit', compact('cart', 'users', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_menu' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
            'sub_total' => 'required|numeric|min:0',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->update($request->all());

        return redirect()->route('carts.index')->with('success', 'Cart item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Cart item deleted successfully.');
    }

    // Add item to cart (Buyer)
    public function add(Request $request)
    {
        $request->validate([
            'id_menu' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->id_menu);

        // Check if menu is available
        if ($menu->status !== 'Available') {
            return back()->with('error', 'This menu is currently unavailable.');
        }

        // Check stock
        if ($menu->stock < $request->jumlah) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        // Check if item already exists in cart
        $existingCart = Cart::where('id_user', Auth::id())
            ->where('id_menu', $request->id_menu)
            ->first();

        if ($existingCart) {
            // Update existing cart item
            $existingCart->update([
                'jumlah' => $existingCart->jumlah + $request->jumlah,
                'sub_total' => ($existingCart->jumlah + $request->jumlah) * $menu->harga
            ]);
        } else {
            // Create new cart item
            Cart::create([
                'id_user' => Auth::id(),
                'id_menu' => $request->id_menu,
                'jumlah' => $request->jumlah,
                'sub_total' => $request->jumlah * $menu->harga
            ]);
        }

        return back()->with('success', 'Item added to cart successfully!');
    }

    public function viewCart()
    {
        $cartItems = Cart::where('id_user', Auth::id())
            ->with('menu')
            ->get();

        return view('carts.mycart', compact('cartItems'));
    }

    public function updateCartItem(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->id_user !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $menu = Menu::findOrFail($cartItem->id_menu);

        if ($request->jumlah > $menu->stock) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $cartItem->update([
            'jumlah' => $request->jumlah,
            'sub_total' => $request->jumlah * $menu->harga
        ]);

        return back()->with('success', 'Cart updated successfully!');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->id_user !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $cartItem->delete();
        return back()->with('success', 'Item removed from cart!');
    }

    public function checkout()
    {
        try {
            DB::beginTransaction();

            $cartItems = Cart::where('id_user', Auth::id())->with('menu')->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            // Create order
            $order = Order::create([
                'id_buyer' => Auth::id(),
                'total_harga' => $cartItems->sum('sub_total'),
                'status_order' => 'Pending'
            ]);

            // Create order details
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'id_order' => $order->id,
                    'id_menu' => $item->id_menu,
                    'quantity' => $item->jumlah,
                    'price' => $item->menu->harga,
                    'subtotal' => $item->sub_total
                ]);

                // Update stock
                $menu = $item->menu;
                $menu->stock -= $item->jumlah;
                $menu->save();
            }

            // Clear cart
            Cart::where('id_user', Auth::id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process checkout. Please try again.');
        }
    }
}
