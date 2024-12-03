<!-- resources/views/order_details/index.blade.php -->
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
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-800">Order Details</h1>
                <div class="flex gap-4">
                    <!-- View Orders Button -->
                    <a href="{{ route('orders.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="h-5 w-5 mr-2" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke="currentColor">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        View Orders
                    </a>
                    
                    <!-- Add Order Detail Button -->
                    <a href="{{ route('order_details.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="h-5 w-5 mr-2" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke="currentColor">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M12 4v16m8-8H4" />
                        </svg>
                        Add Order Detail
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orderDetails as $orderDetail)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $orderDetail->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $orderDetail->order_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $orderDetail->menu->nama_menu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $orderDetail->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($orderDetail->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('order_details.edit', $orderDetail->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('order_details.destroy', $orderDetail->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>