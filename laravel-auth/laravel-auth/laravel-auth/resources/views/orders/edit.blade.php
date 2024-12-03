<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Edit Order</h1>
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id_buyer" class="form-label">Buyer</label>
                <select name="id_buyer" id="id_buyer" class="form-select" required>
                    @foreach ($buyers as $buyer)
                        <option value="{{ $buyer->id }}" {{ $order->id_buyer == $buyer->id ? 'selected' : '' }}>
                            {{ $buyer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" step="0.01" name="total_harga" id="total_harga" class="form-control" value="{{ $order->total_harga }}" required>
            </div>
            <div class="mb-3">
                <label for="status_order" class="form-label">Status</label>
                <select name="status_order" id="status_order" class="form-select" required>
                    <option value="Pending" {{ $order->status_order == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Confirmed" {{ $order->status_order == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Delivered" {{ $order->status_order == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="Canceled" {{ $order->status_order == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
