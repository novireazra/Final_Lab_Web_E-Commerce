<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Edit Payment</h1>
        <form action="{{ route('payments.update', $payment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="id_order" class="block text-sm font-medium text-gray-700">Order</label>
                <select name="id_order" id="id_order" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    @foreach ($orders as $order)
                        <option value="{{ $order->id }}" {{ $payment->id_order == $order->id ? 'selected' : '' }}>
                            Order #{{ $order->id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    <option value="Cash" {{ $payment->metode_pembayaran == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="E-Wallet" {{ $payment->metode_pembayaran == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    <option value="Bank Transfer" {{ $payment->metode_pembayaran == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="status_pembayaran" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                <select name="status_pembayaran" id="status_pembayaran" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    <option value="Pending" {{ $payment->status_pembayaran == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $payment->status_pembayaran == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Failed" {{ $payment->status_pembayaran == 'Failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="tanggal_pembayaran" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                <input type="datetime-local" name="tanggal_pembayaran" id="tanggal_pembayaran" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" value="{{ $payment->tanggal_pembayaran }}">
            </div>
            <button type="submit" class="bg-yellow-500 text-white font-bold py-2 px-4 rounded hover:bg-yellow-700">Update</button>
            <a href="{{ route('payments.index') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-700 ml-2">Cancel</a>
        </form>
    </div>
</x-app-layout>
