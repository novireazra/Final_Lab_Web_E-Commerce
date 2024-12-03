<!-- resources/views/orders/show.blade.php -->
<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Order Details</h1>

        <div class="card mb-4">
            <div class="card-header">
                Order #{{ $order->id }}
            </div>
            <div class="card-body">
                <p><strong>Buyer:</strong> {{ $order->buyer->name }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 2, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ $order->status_order }}</p>
                <p><strong>Tanggal Pesanan:</strong> {{ $order->tanggal_pesanan }}</p>
            </div>
        </div>

        <h2 class="mb-3">Order Items</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->menu->nama_menu }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp {{ number_format($detail->price, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
    </div>
</x-app-layout>