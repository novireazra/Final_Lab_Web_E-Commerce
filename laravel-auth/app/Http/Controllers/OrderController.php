<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('id_buyer', Auth::id())
            ->with(['orderDetails.menu', 'buyer'])
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderDetails.menu', 'buyer'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buyers = User::all(); // Mengambil semua pengguna sebagai buyer
        return view('orders.create', compact('buyers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_buyer' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:0',
            'status_order' => 'required|in:Pending,Confirmed,Delivered,Canceled',
        ]);

        // Create order
        $order = Order::create($request->all());

        // Create initial payment record
        $payment = Payment::create([
            'id_order' => $order->id,
            'metode_pembayaran' => 'Pending', // Default value
            'status_pembayaran' => 'Pending',
            'tanggal_pembayaran' => now()
        ]);

        // Redirect to payment edit page
        return redirect()->route('payments.edit', $payment->id)
            ->with('success', 'Order created successfully. Please complete payment.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $buyers = User::all();
        return view('orders.edit', compact('order', 'buyers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_buyer' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:0',
            'status_order' => 'required|in:Pending,Confirmed,Delivered,Canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function sellerOrders()
    {
        $restaurant = Restaurant::where('id_seller', Auth::id())->first();

        if (!$restaurant) {
            return redirect()->route('dashboard')
                ->with('error', 'You need to create a restaurant first');
        }

        $orders = Order::whereHas('orderDetails.menu', function ($query) use ($restaurant) {
            $query->where('id_restaurant', $restaurant->id);
        })
            ->with(['orderDetails.menu', 'buyer'])
            ->latest()
            ->get();

        return view('seller.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Verify seller owns the restaurant that has items in this order
        $restaurant = Restaurant::where('id_seller', Auth::id())->first();
        $hasItems = $order->orderDetails()->whereHas('menu', function ($query) use ($restaurant) {
            $query->where('id_restaurant', $restaurant->id);
        })->exists();

        if (!$hasItems) {
            return back()->with('error', 'Unauthorized action');
        }

        $order->update([
            'status_order' => $request->status
        ]);

        return back()->with('success', 'Order status updated successfully');
    }
}
