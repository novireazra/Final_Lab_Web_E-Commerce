<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Menus</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Add Menu</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Restaurant</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Kategori</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ optional($menu->restaurant)->nama_restaurant ?? 'No Restaurant' }}</td>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ number_format($menu->harga, 2) }}</td>
                        <td>{{ $menu->status }}</td>
                        <td>{{ $menu->kategori }}</td>
                        <td>
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->nama_menu }}" style="max-width: 100px;">
                        </td>
                        <td>
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No menus found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
