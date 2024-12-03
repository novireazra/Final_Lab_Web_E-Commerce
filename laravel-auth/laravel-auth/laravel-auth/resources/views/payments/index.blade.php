<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Payments</h1>
        <a href="{{ route('payments.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 mb-3">Add Payment</a>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Order ID</th>
                    <th class="py-2 px-4 border-b text-left">Metode Pembayaran</th>
                    <th class="py-2 px-4 border-b text-left">Status Pembayaran</th>
                    <th class="py-2 px-4 border-b text-left">Tanggal Pembayaran</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $payment->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $payment->order->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $payment->metode_pembayaran }}</td>
                        <td class="py-2 px-4 border-b">{{ $payment->status_pembayaran }}</td>
                        <td class="py-2 px-4 border-b">{{ $payment->tanggal_pembayaran }}</td>
                        <td class="py-2 px-4 border-b flex space-x-2">
                            <a href="{{ route('payments.edit', $payment->id) }}" class="bg-yellow-500 text-white font-bold py-1 px-2 rounded hover:bg-yellow-700">Edit</a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white font-bold py-1 px-2 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No payments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
