<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-left">Restaurant Name</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $restaurant)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $restaurant->nama_restaurant }}</td>
                                    <td class="px-4 py-2">{{ $restaurant->status_buka }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
