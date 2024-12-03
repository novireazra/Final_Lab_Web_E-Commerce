<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-red-100 shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Menu Management</h1>

        @if (auth()->user()->role === 'seller' && !auth()->user()->menus)
            <div class="mb-6 flex justify-end">
                <a href="{{ route('menus.create') }}"
                    class="px-6 py-3 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-500 focus:ring focus:ring-red-300 transition-all">
                    Add Menu
                </a>
            </div>
        @endif

        @if(session('success'))
            <div class="text-sm text-green-600 bg-green-100 px-6 py-3 rounded-lg shadow-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse ($menus as $menu)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->nama_menu }}" class="w-full h-48 object-cover rounded-t-lg transition-all hover:scale-105">

                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $menu->nama_menu }}</h2>
                        <p class="text-gray-600 mb-1">Price: <span class="font-semibold text-red-600">Rp {{ number_format($menu->harga, 2) }}</span></p>
                        <p class="text-gray-600 mb-1">Category: <span class="text-yellow-600">{{ $menu->kategori }}</span></p>
                        <p class="text-gray-600 mb-1">Status: 
                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                {{ $menu->status == 'Available' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $menu->status }}
                            </span>
                        </p>
                        <p class="text-gray-600 mb-1">Restaurant: {{ optional($menu->restaurant)->nama_restaurant ?? 'No Restaurant' }}</p>
                        <p class="text-gray-600 mb-4">Stock: {{ $menu->stock }}</p>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('menus.edit', $menu->id) }}"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-400 focus:outline-none focus:ring focus:ring-yellow-300 transition-all">
                                Edit
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-400 focus:outline-none focus:ring focus:ring-red-300 transition-all">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">No menus found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
