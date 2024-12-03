<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Review') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Review</h1>
        <form action="{{ route('reviews.update', $review->id_review) }}" method="POST" class="space-y-6 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div>
                <label for="id_buyer" class="block text-gray-700 font-medium">Buyer</label>
                <select name="id_buyer" id="id_buyer" class="block w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                    @foreach ($buyers as $buyer)
                        <option value="{{ $buyer->id }}" {{ $review->id_buyer == $buyer->id ? 'selected' : '' }}>
                            {{ $buyer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_restaurant" class="block text-gray-700 font-medium">Restaurant</label>
                <select name="id_restaurant" id="id_restaurant" class="block w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                    @foreach ($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}" {{ $review->id_restaurant == $restaurant->id ? 'selected' : '' }}>
                            {{ $restaurant->nama_restaurant }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="rating" class="block text-gray-700 font-medium">Rating</label>
                <input type="number" name="rating" id="rating" class="block w-full mt-2 p-2 border border-gray-300 rounded-md" value="{{ $review->rating }}" min="1" max="5" required>
            </div>

            <div>
                <label for="komentar" class="block text-gray-700 font-medium">Komentar</label>
                <textarea name="komentar" id="komentar" class="block w-full mt-2 p-2 border border-gray-300 rounded-md" rows="4" required>{{ $review->komentar }}</textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('reviews.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
