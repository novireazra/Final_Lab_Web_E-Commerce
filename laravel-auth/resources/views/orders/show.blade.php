<!-- resources/views/orders/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Order Details') }}
            </h2>
            <a href="{{ url('/') }}"
                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Order #{{ $order->id }}</h3>
                </div>
                <div class="px-6 py-4">
                    <p><strong>Buyer:</strong> {{ $order->buyer->name }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 2, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ $order->status_order }}</p>
                    <p><strong>Tanggal Pesanan:</strong> {{ $order->tanggal_pesanan }}</p>
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-4">Order Items</h2>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $detail->menu->nama_menu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $detail->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($detail->price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-md hover:bg-gray-700 transition">
                    Back to Orders
                </a>
                @if($order->status_order == 'Pending')
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input type="hidden" name="metode_pembayaran" value="E-Wallet"> <!-- Contoh metode pembayaran -->
                        <input type="hidden" name="status_pembayaran" value="Completed"> <!-- Contoh status pembayaran -->
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">
                            Pay Now
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>