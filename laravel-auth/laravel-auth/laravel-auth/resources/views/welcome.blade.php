<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoFood - Food Delivery</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-red-500 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-3xl font-bold">GoFood</h1>
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

    <!-- Main Content -->
    <div class="container mx-auto mt-8">
        <!-- Search Bar Section -->
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <div class="flex items-center">
                <input type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Cari makanan atau restoran">
                <button class="ml-4 bg-red-500 text-white px-4 py-2 rounded-lg">Cari</button>
            </div>
        </div>

        <!-- Category Section -->
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/80" alt="Category 1" class="mx-auto mb-4">
                <h3 class="font-semibold text-lg">Makanan</h3>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/80" alt="Category 2" class="mx-auto mb-4">
                <h3 class="font-semibold text-lg">Minuman</h3>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/80" alt="Category 3" class="mx-auto mb-4">
                <h3 class="font-semibold text-lg">Snack</h3>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/80" alt="Category 4" class="mx-auto mb-4">
                <h3 class="font-semibold text-lg">Restoran</h3>
            </div>
        </div>

        <!-- Featured Section -->
        <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-800">Promo Terbaru</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://via.placeholder.com/400x300" alt="Promo 1" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">Promo 1</h3>
                        <p class="text-gray-600 mt-2">Nikmati diskon hingga 50% untuk makanan favoritmu!</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://via.placeholder.com/400x300" alt="Promo 2" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">Promo 2</h3>
                        <p class="text-gray-600 mt-2">Diskon besar untuk pengiriman pertama.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://via.placeholder.com/400x300" alt="Promo 3" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">Promo 3</h3>
                        <p class="text-gray-600 mt-2">Beli 1 gratis 1, hanya hari ini!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-8 p-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 GoFood. All rights reserved.</p>
            <div class="mt-4 space-x-6">
                <a href="#" class="text-white hover:underline">About Us</a>
                <a href="#" class="text-white hover:underline">Privacy Policy</a>
                <a href="#" class="text-white hover:underline">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>