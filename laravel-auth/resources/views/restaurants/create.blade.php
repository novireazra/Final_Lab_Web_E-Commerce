<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Create Restaurant') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-red-50 to-red-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-8">
                            <!-- Restaurant Name -->
                            <div class="mb-6">
                                <label for="nama_restaurant" class="block text-lg font-medium text-gray-700">Restaurant Name</label>
                                <input type="text" name="nama_restaurant" id="nama_restaurant" class="form-input mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <label for="deskripsi" class="block text-lg font-medium text-gray-700">Description</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-input mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" rows="4" required></textarea>
                            </div>

                            <!-- Address -->
                            <div class="mb-6">
                                <label for="alamat" class="block text-lg font-medium text-gray-700">Address</label>
                                <input type="text" name="alamat" id="alamat" class="form-input mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3" required>
                            </div>

                            <!-- Status -->
                            <div class="mb-6">
                                <label for="status_buka" class="block text-lg font-medium text-gray-700">Status</label>
                                <select name="status_buka" id="status_buka" class="form-select mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3">
                                    <option value="Open">Open</option>
                                    <option value="Close">Close</option>
                                </select>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-6">
                                <label for="image" class="block text-lg font-medium text-gray-700">Image</label>
                                <input type="file" name="image" id="image" class="form-input mt-2 block w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all p-3">
                                <p class="text-sm text-gray-500 mt-1">Max size: 2MB (JPEG, PNG, JPG)</p>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end">
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition ease-in-out duration-300">
                                    Create Restaurant
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
