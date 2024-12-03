<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class Order_DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderDetails = OrderDetail::with(['order', 'menu'])->latest()->get();
        return view('order_details.index', compact('orderDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        $menus = Menu::all();
        return view('order_details.create', compact('orders', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_order' => 'required|exists:orders,id',
            'id_menu' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
            'sub_total' => 'required|numeric|min:0',
        ]);

        OrderDetail::create($request->all());

        return redirect()->route('order_details.index')->with('success', 'Order detail created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orders = Order::all();
        $menus = Menu::all();
        return view('order_details.edit', compact('orderDetail', 'orders', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_order' => 'required|exists:orders,id',
            'id_menu' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->update($request->all());

        return redirect()->route('order_details.index')->with('success', 'Order detail updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();

        return redirect()->route('order_details.index')->with('success', 'Order detail deleted successfully.');
    }
}
