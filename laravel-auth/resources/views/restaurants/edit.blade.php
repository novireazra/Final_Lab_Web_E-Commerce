<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Restaurant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama_restaurant" class="block text-sm font-medium">Restaurant Name</label>
                            <input type="text" name="nama_restaurant" id="nama_restaurant" class="form-input mt-1 block w-full" value="{{ old('nama_restaurant', $restaurant->nama_restaurant) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium">Description</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-input mt-1 block w-full" rows="4" required>{{ old('deskripsi', $restaurant->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium">Address</label>
                            <input type="text" name="alamat" id="alamat" class="form-input mt-1 block w-full" value="{{ old('alamat', $restaurant->alamat) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="status_buka" class="block text-sm font-medium">Status</label>
                            <select name="status_buka" id="status_buka" class="form-select mt-1 block w-full">
                                <option value="Open" {{ $restaurant->status_buka == 'Open' ? 'selected' : '' }}>Open</option>
                                <option value="Close" {{ $restaurant->status_buka == 'Close' ? 'selected' : '' }}>Close</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium">Image</label>
                            <input type="file" name="image" id="image" class="form-input mt-1 block w-full">
                            @if ($restaurant->image)
                                <div class="mt-2">
                                    <img src="{{ $restaurant->getImageUrlAttribute() }}" alt="Restaurant Image" class="w-32 h-32 object-cover">
                                    <p class="text-xs text-gray-500">Current image</p>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="btn btn-primary">Update Restaurant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
