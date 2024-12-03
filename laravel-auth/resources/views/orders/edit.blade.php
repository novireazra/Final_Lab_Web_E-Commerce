<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Order</h1>
        
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Buyer Selection -->
            <div class="mb-4">
                <label for="id_buyer" class="block text-gray-700 text-lg font-medium">Buyer</label>
                <select name="id_buyer" id="id_buyer" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @foreach ($buyers as $buyer)
                        <option value="{{ $buyer->id }}" {{ $order->id_buyer == $buyer->id ? 'selected' : '' }}>
                            {{ $buyer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Total Harga -->
            <div class="mb-4">
                <label for="total_harga" class="block text-gray-700 text-lg font-medium">Total Harga</label>
                <input type="number" step="0.01" name="total_harga" id="total_harga" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ $order->total_harga }}" required>
            </div>
            
            <!-- Status Order -->
            <div class="mb-6">
                <label for="status_order" class="block text-gray-700 text-lg font-medium">Status</label>
                <select name="status_order" id="status_order" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="Pending" {{ $order->status_order == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Confirmed" {{ $order->status_order == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Delivered" {{ $order->status_order == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="Canceled" {{ $order->status_order == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>
            
            <!-- Buttons -->
            <div class="flex justify-between">
                <button type="submit" class="px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-colors">Update</button>
                <a href="{{ route('orders.index') }}" class="px-6 py-2 bg-gray-400 text-white font-semibold rounded-lg hover:bg-gray-500 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
