<!-- resources/views/orders/index.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">My Orders</h2>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @forelse($orders as $order)
                        <div class="mb-8 border rounded-lg overflow-hidden">
                            <!-- Order Header -->
                            <div class="bg-gray-50 px-6 py-4 border-b">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-semibold">Order #{{ $order->id }}</h3>
                                        <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span
                                            class="px-4 py-2 rounded-full text-sm font-semibold
                                            {{ $order->status_order === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $order->status_order === 'Confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $order->status_order === 'Delivered' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $order->status_order === 'Canceled' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ $order->status_order }}
                                        </span>

                                        {{-- @if ($order->status_order === 'Pending')
                                            <a href="{{ route('payments.create', ['order_id' => $order->id]) }}"
                                                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                                                Complete Payment
                                            </a>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>

                            <!-- Rest of your existing order details code -->
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <p>No orders found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
