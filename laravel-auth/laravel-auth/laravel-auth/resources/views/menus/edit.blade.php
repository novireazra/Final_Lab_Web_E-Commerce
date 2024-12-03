<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form untuk mengedit menu -->
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_menu" class="block text-gray-700">Menu Name</label>
                            <input type="text" name="nama_menu" id="nama_menu" value="{{ $menu->nama_menu }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi_menu" class="block text-gray-700">Description</label>
                            <textarea name="deskripsi_menu" id="deskripsi_menu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $menu->deskripsi_menu }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-gray-700">Price</label>
                            <input type="number" name="harga" id="harga" value="{{ $menu->harga }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_restaurant" class="block text-gray-700">Restaurant</label>
                            <select name="id_restaurant" id="id_restaurant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}" {{ $menu->id_restaurant == $restaurant->id ? 'selected' : '' }}>
                                        {{ $restaurant->nama_restaurant }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="Available" {{ $menu->status == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Unavailable" {{ $menu->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="kategori" class="block text-gray-700">Category</label>
                            <input type="text" name="kategori" id="kategori" value="{{ $menu->kategori }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="stock" class="block text-gray-700">Stock</label>
                            <input type="number" name="stock" id="stock" value="{{ $menu->stock }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700">Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                            @if ($menu->image)
                                <img src="{{ $menu->image_url }}" alt="{{ $menu->nama_menu }}" class="w-16 h-16 object-cover rounded-lg mt-2">
                            @endif
                        </div>
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                            Update Menu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
