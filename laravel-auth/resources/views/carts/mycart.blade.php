<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-3xl font-bold mb-6">My Cart</h2>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($cartItems->isEmpty())
                    <p class="text-gray-500">Your cart is empty.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checkout</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if ($item->menu->image)
                                                    <img src="{{ asset('storage/' . $item->menu->image) }}" class="h-12 w-12 object-cover rounded-md mr-4">
                                                @endif
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->menu->nama_menu }}</div>
                                                    <div class="text-sm text-gray-500">{{ Str::limit($item->menu->deskripsi_menu, 50) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($item->menu->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->menu->stock }}" class="w-20 rounded-md border-gray-300 mr-2">
                                                <button type="submit" class="text-blue-600 hover:text-blue-900">Update</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($item->sub_total, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('cart.checkout') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                                                    Checkout
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-gray-50">
                                    <td colspan="4" class="px-6 py-4 text-right font-bold">Total:</td>
                                    <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">
                                        Rp {{ number_format($cartItems->sum('sub_total'), 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 text-right">
                        <form action="{{ route('cart.checkoutAll') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition">
                                Checkout All
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>