<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Favorit List</h1>
        <a href="{{ route('favorits.create') }}" class="btn btn-primary mb-3">Add Favorit</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Menu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($favorits as $favorit)
                    <tr>
                        <td>{{ $favorit->id }}</td>
                        <td>{{ $favorit->user->name }}</td>
                        <td>{{ $favorit->menu->nama_menu }}</td>
                        <td>
                            <a href="{{ route('favorits.edit', $favorit->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('favorits.destroy', $favorit->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No favorits found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
