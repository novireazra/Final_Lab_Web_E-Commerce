<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-gradient-to-r from-red-100 via-yellow-100 to-red-100 shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Menu Management</h1>

        @if (auth()->user()->role === 'seller' && !auth()->user()->menus)
            <div class="mb-4 flex justify-end">
                <a href="{{ route('menus.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 focus:ring focus:ring-blue-300">
                    Add Menu
                </a>
            </div>
        @endif

        @if(session('success'))
            <div class="text-sm text-green-600 bg-green-100 px-4 py-2 rounded-lg shadow mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($menus as $menu)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->nama_menu }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-lg font-bold text-gray-800">{{ $menu->nama_menu }}</h2>
                        <p class="text-gray-600">Price: Rp {{ number_format($menu->harga, 2) }}</p>
                        <p class="text-gray-600">Category: {{ $menu->kategori }}</p>
                        <p class="text-gray-600">Status: 
                            <span class="px-2 py-1 rounded-lg text-sm font-medium 
                                {{ $menu->status == 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $menu->status }}
                            </span>
                        </p>
                        <p class="text-gray-600">Restaurant: {{ optional($menu->restaurant)->nama_restaurant ?? 'No Restaurant' }}</p>
                        <p class="text-gray-600">Stock: {{ $menu->stock }}</p>
                        <div class="mt-4 flex justify-end gap-2">
                            <a href="{{ route('menus.edit', $menu->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-lg shadow hover:bg-yellow-400">
                                Edit
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white text-sm rounded-lg shadow hover:bg-red-400">
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
