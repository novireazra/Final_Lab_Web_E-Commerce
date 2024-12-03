<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BiteFly - Food Delivery</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-red-500 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="GoFood Logo" class="h-20">
            </a>
            @if (Route::has('login'))
                <nav class="space-x-4 text-white">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hover:underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hover:underline">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-96" style="background-image: url('{{ asset('images/banner.jpg') }}');">
        <div class="container mx-auto h-full flex items-center justify-center">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Pesan Makanan Favoritmu</h2>
                <p class="text-xl mb-8">Dari restoran terbaik di sekitarmu</p>
                <a href="{{ route('start-order') }}" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition-all">Mulai Pesan</a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto mt-8">
        <!-- Search Bar Section -->
        <div id="search" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Cari makanan atau restoran">
                <button class="ml-4 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all">Cari</button>
            </div>
        </div>

        <!-- Category Section -->
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center transform transition duration-500 hover:scale-105">
                <i class="fas fa-hamburger text-6xl text-red-500 mb-4"></i>
                <h3 class="font-semibold text-lg">Makanan</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center transform transition duration-500 hover:scale-105">
                <i class="fas fa-coffee text-6xl text-red-500 mb-4"></i>
                <h3 class="font-semibold text-lg">Minuman</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center transform transition duration-500 hover:scale-105">
                <i class="fas fa-cookie-bite text-6xl text-red-500 mb-4"></i>
                <h3 class="font-semibold text-lg">Snack</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center transform transition duration-500 hover:scale-105">
                <i class="fas fa-utensils text-6xl text-red-500 mb-4"></i>
                <h3 class="font-semibold text-lg">Restoran</h3>
            </div>
        </div>

        <!-- Featured Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800">Menu Terbaru</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach ($menus as $menu)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105">
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->nama_menu }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $menu->nama_menu }}</h3>
                            <p class="text-gray-600 mt-2">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            <p class="text-gray-600 mt-2">{{ $menu->deskripsi_menu }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-red-800 text-white mt-12 p-6">
        <div class="container mx-auto text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-white hover:underline">About Us</a>
                <a href="#" class="text-white hover:underline">Privacy Policy</a>
                <a href="#" class="text-white hover:underline">Terms of Service</a>
            </div>
            <p>&copy; 2024 BiteFly. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>