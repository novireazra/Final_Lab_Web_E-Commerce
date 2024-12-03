<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Add Favorit</h1>
        <form action="{{ route('favorits.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_user" class="form-label">User</label>
                <select name="id_user" id="id_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id_menu" class="form-label">Menu</label>
                <select name="id_menu" id="id_menu" class="form-select" required>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('favorits.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
