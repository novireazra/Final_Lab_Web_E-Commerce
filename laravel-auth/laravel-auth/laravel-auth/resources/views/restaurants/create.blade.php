<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Restaurant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_restaurant" class="block text-sm font-medium">Restaurant Name</label>
                            <input type="text" name="nama_restaurant" id="nama_restaurant" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium">Description</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-input mt-1 block w-full" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium">Address</label>
                            <input type="text" name="alamat" id="alamat" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="status_buka" class="block text-sm font-medium">Status</label>
                            <select name="status_buka" id="status_buka" class="form-select mt-1 block w-full">
                                <option value="Open">Open</option>
                                <option value="Close">Close</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium">Image</label>
                            <input type="file" name="image" id="image" class="form-input mt-1 block w-full">
                            <p class="text-xs text-gray-500">Max size: 2MB (JPEG, PNG, JPG)</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="btn btn-primary">Create Restaurant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
