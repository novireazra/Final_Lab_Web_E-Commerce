<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'order_id' => 'required|exists:orders,id',
            'metode_pembayaran' => 'required|in:Cash,E-Wallet,Bank Transfer',
            'status_pembayaran' => 'required|in:Pending,Completed,Failed',
            'tanggal_pembayaran' => 'nullable|date',
        ]);

        $order = Order::findOrFail($request->order_id);

        // Proses pembayaran di sini (misalnya, integrasi dengan gateway pembayaran)

        // Misalnya, kita anggap pembayaran berhasil
        $validatedData = $request->only(['metode_pembayaran', 'status_pembayaran', 'tanggal_pembayaran']);
        $validatedData['id_order'] = $order->id;
        $validatedData['user_id'] = Auth::id();
        $validatedData['status_pembayaran'] = 'Completed';
        $validatedData['tanggal_pembayaran'] = now();

        Payment::create($validatedData);

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
            'order_id' => 'required|exists:orders,id',
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