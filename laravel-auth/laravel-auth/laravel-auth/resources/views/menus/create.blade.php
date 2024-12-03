<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form untuk membuat menu -->
                    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_menu" class="block text-gray-700">Menu Name</label>
                            <input type="text" name="nama_menu" id="nama_menu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi_menu" class="block text-gray-700">Description</label>
                            <textarea name="deskripsi_menu" id="deskripsi_menu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-gray-700">Price</label>
                            <input type="number" name="harga" id="harga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_restaurant" class="block text-gray-700">Restaurant</label>
                            <select name="id_restaurant" id="id_restaurant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->nama_restaurant }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="kategori" class="block text-gray-700">Category</label>
                            <input type="text" name="kategori" id="kategori" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="stock" class="block text-gray-700">Stock</label>
                            <input type="number" name="stock" id="stock" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700">Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                            Save Menu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
