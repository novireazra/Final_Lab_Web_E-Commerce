<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Edit Favorit</h1>
        <form action="{{ route('favorits.update', $favorit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id_user" class="form-label">User</label>
                <select name="id_user" id="id_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $favorit->id_user == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id_menu" class="form-label">Menu</label>
                <select name="id_menu" id="id_menu" class="form-select" required>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $favorit->id_menu == $menu->id ? 'selected' : '' }}>
                            {{ $menu->nama_menu }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('favorits.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
