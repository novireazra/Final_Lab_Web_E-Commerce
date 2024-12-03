<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Dashboard Pembeli') }}
            </h2>
            <a href="{{ url('/') }}"
                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Pencarian -->
            <div class="mb-8 flex justify-between items-center">
                <input type="text" id="search" placeholder="Cari Menu atau Restoran..."
                    class="px-4 py-2 w-1/2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                <button id="search-button"
                    class="ml-4 bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-all">
                    Cari
                </button>
            </div>

            <!-- Daftar Restoran -->
            @if($restaurants->isEmpty())
                <div class="text-center py-6">
                    <p class="text-xl text-gray-600">Tidak ada restoran yang tersedia.</p>
                </div>
            @else
                @foreach ($restaurants as $restaurant)
                    <div class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 hover:scale-105">
                        <div class="p-6">
                            <!-- Nama Restoran -->
                            <h3 class="text-3xl font-semibold text-gray-900 mb-4 restoran-name">
                                {{ $restaurant->nama_restaurant }}</h3>

                            <!-- Grid Menu -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($restaurant->menus as $menu)
                                    <div
                                        class="bg-white border rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all menu-item transform transition duration-500 hover:scale-105">
                                        @if ($menu->image)
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nama_menu }}"
                                                class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-300"></div>
                                        @endif
                                        <div class="p-5">
                                            <h4 class="text-xl font-semibold text-gray-800 mb-3 menu-name">
                                                {{ $menu->nama_menu }}</h4>
                                            <p class="text-gray-600 text-sm mb-3 menu-description">
                                                {{ $menu->deskripsi_menu }}</p>
                                            <p class="text-lg font-bold text-gray-900 mb-4">Rp
                                                {{ number_format($menu->harga, 0, ',', '.') }}</p>

                                            <div class="flex justify-between items-center mb-4">
                                                <!-- Keranjang Button -->
                                                <div class="flex items-center space-x-3">
                                                    <form action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_menu" value="{{ $menu->id }}">
                                                        <div class="flex items-center gap-3 mb-4">
                                                            <label class="text-sm text-gray-700">Jumlah:</label>
                                                            <input type="number" name="jumlah" value="1"
                                                                min="1" max="{{ $menu->stock }}"
                                                                class="w-20 rounded-md border-gray-300 shadow-sm">
                                                        </div>
                                                        <button type="submit"
                                                            class="w-full bg-orange-500 text-white px-4 py-3 rounded-lg hover:bg-orange-600 transition-all">
                                                            Tambah ke Keranjang
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Favorit Button di sebelah kanan -->
                                                <a href="#" class="favorite-button text-red-500 hover:text-red-600 transition-colors duration-200" data-menu-id="{{ $menu->id }}">
                                                    <i class="bi bi-heart w-10 h-10"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        // Fungsi untuk menangani pencarian menu dan restoran
        document.getElementById('search-button').addEventListener('click', function() {
            let searchQuery = document.getElementById('search').value.toLowerCase();
            let restaurants = document.querySelectorAll('.restoran-name');
            let menuItems = document.querySelectorAll('.menu-item');

            // Loop untuk menyaring restoran
            restaurants.forEach(function(restaurant) {
                let restaurantName = restaurant.textContent.toLowerCase();
                let parentDiv = restaurant.closest('.mb-8'); // Menyaring restoran beserta menunya

                // Jika nama restoran atau menu cocok, tampilkan restoran dan menu
                if (restaurantName.includes(searchQuery)) {
                    parentDiv.style.display = 'block';
                } else {
                    parentDiv.style.display = 'none';
                }
            });

            // Loop untuk menyaring menu berdasarkan pencarian
            menuItems.forEach(function(menu) {
                let menuName = menu.querySelector('.menu-name').textContent.toLowerCase();
                let menuDescription = menu.querySelector('.menu-description').textContent.toLowerCase();

                // Menyembunyikan atau menampilkan menu berdasarkan pencarian
                if (menuName.includes(searchQuery) || menuDescription.includes(searchQuery)) {
                    menu.style.display = 'block';
                } else {
                    menu.style.display = 'none';
                }
            });
        });

        // Fungsi untuk menambahkan ke favorit
        document.querySelectorAll('.favorite-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const menuId = this.dataset.menuId;

                fetch('{{ route("favorit.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ menu_id: menuId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Menu added to favorites');
                    } else {
                        alert('Failed to add menu to favorites');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to add menu to favorites');
                });
            });
        });
    </script>

    <!-- Menambahkan link Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</x-app-layout>