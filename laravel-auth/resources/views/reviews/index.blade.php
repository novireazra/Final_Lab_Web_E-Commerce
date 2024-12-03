<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Reviews</h1>
        <a href="{{ route('reviews.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mb-4 inline-block">Add Review</a>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-sm uppercase">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Buyer</th>
                        <th class="px-6 py-3">Restaurant</th>
                        <th class="px-6 py-3">Rating</th>
                        <th class="px-6 py-3">Komentar</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr class="text-gray-700 hover:bg-gray-50">
                            <td class="px-6 py-3 text-center">{{ $review->id_review }}</td>
                            <td class="px-6 py-3">{{ $review->buyer->name }}</td>
                            <td class="px-6 py-3">{{ $review->restaurant->nama_restaurant }}</td>
                            <td class="px-6 py-3 text-center">{{ $review->rating }}</td>
                            <td class="px-6 py-3">{{ $review->komentar }}</td>
                            <td class="px-6 py-3 text-center">{{ $review->tanggal_review }}</td>
                            <td class="px-6 py-3 text-center flex justify-center space-x-2">
                                <a href="{{ route('reviews.edit', $review->id_review) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('reviews.destroy', $review->id_review) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">No reviews found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
