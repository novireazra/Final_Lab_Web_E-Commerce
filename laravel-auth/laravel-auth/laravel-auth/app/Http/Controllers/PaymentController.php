<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('order')->latest()->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view('payments.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_order' => 'required|exists:orders,id',
            'metode_pembayaran' => 'required|in:Cash,E-Wallet,Bank Transfer',
            'status_pembayaran' => 'required|in:Pending,Completed,Failed',
            'tanggal_pembayaran' => 'nullable|date',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $orders = Order::all();
        return view('payments.edit', compact('payment', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_order' => 'required|exists:orders,id',
            'metode_pembayaran' => 'required|in:Cash,E-Wallet,Bank Transfer',
            'status_pembayaran' => 'required|in:Pending,Completed,Failed',
            'tanggal_pembayaran' => 'nullable|date',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
