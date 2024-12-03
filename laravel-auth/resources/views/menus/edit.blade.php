<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-6 p-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form untuk mengedit menu -->
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-8">
                            <!-- Menu Name -->
                            <div class="mb-6">
                                <label for="nama_menu" class="block text-lg font-medium text-gray-700">Menu Name</label>
                                <input type="text" name="nama_menu" id="nama_menu" value="{{ $menu->nama_menu }}" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <label for="deskripsi_menu" class="block text-lg font-medium text-gray-700">Description</label>
                                <textarea name="deskripsi_menu" id="deskripsi_menu" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" rows="4" required>{{ $menu->deskripsi_menu }}</textarea>
                            </div>

                            <!-- Price -->
                            <div class="mb-6">
                                <label for="harga" class="block text-lg font-medium text-gray-700">Price</label>
                                <input type="number" name="harga" id="harga" value="{{ $menu->harga }}" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                            </div>

                            <!-- Restaurant -->
                            <div class="mb-6">
                                <label for="id_restaurant" class="block text-lg font-medium text-gray-700">Restaurant</label>
                                <select name="id_restaurant" id="id_restaurant" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                                    @foreach($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}" {{ $menu->id_restaurant == $restaurant->id ? 'selected' : '' }}>
                                            {{ $restaurant->nama_restaurant }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="mb-6">
                                <label for="status" class="block text-lg font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                                    <option value="Available" {{ $menu->status == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Unavailable" {{ $menu->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                            </div>

                            <!-- Category -->
                            <div class="mb-6">
                                <label for="kategori" class="block text-lg font-medium text-gray-700">Category</label>
                                <input type="text" name="kategori" id="kategori" value="{{ $menu->kategori }}" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                            </div>

                            <!-- Stock -->
                            <div class="mb-6">
                                <label for="stock" class="block text-lg font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" id="stock" value="{{ $menu->stock }}" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-6">
                                <label for="image" class="block text-lg font-medium text-gray-700">Image</label>
                                <input type="file" name="image" id="image" class="mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" accept="image/*">
                                @if ($menu->image)
                                    <div class="mt-4">
                                        <img src="{{ $menu->image_url }}" alt="{{ $menu->nama_menu }}" class="w-16 h-16 object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end">
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition ease-in-out duration-300">
                                    Update Menu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
