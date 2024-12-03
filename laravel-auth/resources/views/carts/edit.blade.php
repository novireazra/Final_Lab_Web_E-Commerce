<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Edit Cart Item</h1>
        <form action="{{ route('carts.update', $cart->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id_user" class="form-label">User</label>
                <select name="id_user" id="id_user" class="form-select" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $cart->id_user == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id_menu" class="form-label">Menu</label>
                <select name="id_menu" id="id_menu" class="form-select" required>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $cart->id_menu == $menu->id ? 'selected' : '' }}>
                            {{ $menu->nama_menu }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $cart->jumlah }}" required>
            </div>
            <div class="mb-3">
                <label for="sub_total" class="form-label">Sub Total</label>
                <input type="number" step="0.01" name="sub_total" id="sub_total" class="form-control" value="{{ $cart->sub_total }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('carts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
