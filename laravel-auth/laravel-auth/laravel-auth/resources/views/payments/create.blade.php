<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Add Payment</h1>
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_order" class="block text-sm font-medium text-gray-700">Order</label>
                <select name="id_order" id="id_order" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    @foreach ($orders as $order)
                        <option value="{{ $order->id }}">Order #{{ $order->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    <option value="Cash">Cash</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="status_pembayaran" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Failed">Failed</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="tanggal_pembayaran" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                <input type="datetime-local" name="tanggal_pembayaran" id="tanggal_pembayaran" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            </div>
            <button type="submit" class="bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-700">Save</button>
            <a href="{{ route('payments.index') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-700 ml-2">Cancel</a>
        </form>
    </div>
</x-app-layout>
