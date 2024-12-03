<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Create Order</h1>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_buyer" class="form-label">Buyer</label>
                <select name="id_buyer" id="id_buyer" class="form-select" required>
                    @foreach ($buyers as $buyer)
                        <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" step="0.01" name="total_harga" id="total_harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status_order" class="form-label">Status</label>
                <select name="status_order" id="status_order" class="form-select" required>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Canceled">Canceled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
