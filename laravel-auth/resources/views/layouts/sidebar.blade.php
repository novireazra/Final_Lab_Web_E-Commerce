<div class="flex min-h-screen bg-red-100">
    <!-- Sidebar -->
    @auth
        @if (Auth::user()->role === 'admin')
            <div class="w-64 bg-red-800 text-white p-6 fixed h-full top-0 left-0 shadow-lg">
                <h3 class="text-2xl font-semibold text-white mb-8">Admin Panel</h3>
                <ul>
                    <!-- Dashboard -->
                    <li class="mb-6">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Dashboard') }}
                        </a>
                    </li>

                    <!-- Lihat Profile -->
                    <li class="mb-6">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Profile -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2c3.31 0 6 2.69 6 6 0 3.31-2.69 6-6 6-3.31 0-6-2.69-6-6 0-3.31 2.69-6 6-6zM12 14c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z">
                                </path>
                            </svg>
                            {{ __('Lihat Profile') }}
                        </a>
                    </li>

                    <!-- Lihat Users -->
                    <li class="mb-6">
                        <a href="{{ route('admin.index') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon User -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                                </path>
                            </svg>
                            {{ __('Lihat Users') }}
                        </a>
                    </li>

                    <!-- Daftar Restaurant -->
                    <li class="mb-6">
                        <a href="{{ route('restaurants.index') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Restaurant -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2l3 7h4l-5 4 1 7-6-5-6 5 1-7-5-4h4z"></path>
                            </svg>
                            {{ __('Daftar Restaurant') }}
                        </a>
                    </li>

                    <!-- Lihat Daftar Menu -->
                    <li class="mb-6">
                        <a href="{{ route('menus.index') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Menu -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 6h14M5 18h14"></path>
                            </svg>
                            {{ __('Lihat Daftar Menu') }}
                        </a>
                    </li>
                </ul>

                <!-- Logout Button -->
                <div class="absolute bottom-6 left-6 right-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </div>
        @elseif (Auth::user()->role === 'buyer')
            <div class="w-64 bg-red-800 text-white p-6 fixed h-full top-0 left-0 shadow-lg">
                <h3 class="text-2xl font-semibold text-white mb-8">Buyer Panel</h3>
                <ul>
                    <!-- Dashboard -->
                    <li class="mb-6">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Dashboard') }}
                        </a>
                    </li>

                    <!-- Lihat Profile -->
                    <li class="mb-6">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Profile -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2c3.31 0 6 2.69 6 6 0 3.31-2.69 6-6 6-3.31 0-6-2.69-6-6 0-3.31 2.69-6 6-6zM12 14c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z">
                                </path>
                            </svg>
                            {{ __('Lihat Profile') }}
                        </a>
                    </li>

                    <!-- My Cart -->
                    <li class="mb-6">
                        <a href="{{ route('cart.view') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Shopping Cart Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            {{ __('My Cart') }}
                        </a>
                    </li>

                    <li class="mb-6">
                        <a href="{{ route('favorits.index') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Favorit -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z">
                                </path>
                            </svg>
                            {{ __('Favorit') }}
                        </a>
    </li>

                    <!-- My Orders -->
                    <li class="mb-6">
                        <a href="{{ route('orders.index') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Order -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2l3 7h4l-5 4 1 7-6-5-6 5 1-7-5-4h4z"></path>
                            </svg>
                            {{ __('My Orders') }}
                        </a>
                    </li>
                </ul>

                <!-- Logout Button -->
                <div class="absolute bottom-6 left-6 right-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </div>
        @elseif (Auth::user()->role === 'seller')
            <div class="w-64 bg-red-800 text-white p-6 fixed h-full top-0 left-0 shadow-lg">
                <h3 class="text-2xl font-semibold text-white mb-8">Seller Panel</h3>
                <ul>
                    <!-- Dashboard -->
                    <li class="mb-6">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Dashboard') }}
                        </a>
                    </li>

                    <!-- Lihat Profile -->
                    <li class="mb-6">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Profile -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2c3.31 0 6 2.69 6 6 0 3.31-2.69 6-6 6-3.31 0-6-2.69-6-6 0-3.31 2.69-6 6-6zM12 14c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z">
                                </path>
                            </svg>
                            {{ __('Lihat Profile') }}
                        </a>
                    </li>

                    <!-- My Restaurants -->
                    <li class="mb-6">
                        <a href="{{ route('menus.index') }}"
                            class="flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                            <!-- Ikon Restaurant -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2l3 7h4l-5 4 1 7-6-5-6 5 1-7-5-4h4z"></path>
                            </svg>
                            {{ __('My Restaurants') }}
                        </a>
                    </li>

                    <!-- Logout Button -->
                    <div class="absolute bottom-6 left-6 right-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center text-gray-300 hover:text-white hover:bg-red-700 p-3 rounded-md transition duration-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 mr-3 text-gray-400 group-hover:text-white transition duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </ul>
            </div>
        @endif
    @endauth
</div>
