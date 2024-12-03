<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Buyer') }}
            </h2>
            <a href="{{ url('/') }}"
                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors duration-200">
                Back to Homepage
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Restaurant List -->
            @foreach ($restaurants as $restaurant)
                <div class="mb-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $restaurant->nama_restaurant }}</h3>

                        <!-- Menu Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($restaurant->menus as $menu)
                                <div class="border rounded-lg overflow-hidden shadow-md">
                                    @if ($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nama_menu }}"
                                            class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h4 class="font-semibold text-lg mb-2">{{ $menu->nama_menu }}</h4>
                                        <p class="text-gray-600 mb-2">{{ $menu->deskripsi_menu }}</p>
                                        <p class="text-gray-800 font-bold mb-4">Rp
                                            {{ number_format($menu->harga, 0, ',', '.') }}</p>

                                        @if ($menu->status == 'Available')
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_menu" value="{{ $menu->id }}">
                                                <div class="flex items-center gap-2 mb-4">
                                                    <label class="text-sm">Quantity:</label>
                                                    <input type="number" name="jumlah" value="1" min="1"
                                                        max="{{ $menu->stock }}"
                                                        class="w-20 rounded-md border-gray-300">
                                                </div>
                                                <button type="submit"
                                                    class="w-full bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <p class="text-red-500 text-center py-2">Currently Unavailable</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
