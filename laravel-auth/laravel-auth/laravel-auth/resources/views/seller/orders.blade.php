<!-- resources/views/seller/orders.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->buyer->name }}</td>
                                        <td class="px-6 py-4">
                                            @foreach($order->orderDetails as $detail)
                                                @if($detail->menu->id_restaurant == auth()->user()->restaurants->first()->id)
                                                    <div class="text-sm text-gray-900">
                                                        {{ $detail->menu->nama_menu }} x {{ $detail->quantity }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('seller.orders.update-status', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" 
                                                    class="rounded-md border-gray-300 text-sm">
                                                    <option value="Pending" {{ $order->status_order == 'Pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="Confirmed" {{ $order->status_order == 'Confirmed' ? 'selected' : '' }}>
                                                        Confirmed
                                                    </option>
                                                    <option value="Delivered" {{ $order->status_order == 'Delivered' ? 'selected' : '' }}>
                                                        Delivered
                                                    </option>
                                                    <option value="Canceled" {{ $order->status_order == 'Canceled' ? 'selected' : '' }}>
                                                        Canceled
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            No orders found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>