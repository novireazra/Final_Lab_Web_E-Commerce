<!-- resources/views/dashboard/seller/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Seller') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-gradient-to-r from-red-500 via-orange-400 to-red-500">
                    <h3 class="text-2xl font-bold text-white mb-4">Manage Your Business</h3>

                    @php
                        $restaurant = auth()->user()->restaurants()->first();
                    @endphp

                    @if ($restaurant)
                        <!-- User sudah memiliki restoran -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            <!-- Restaurant Management -->
                            <a href="{{ route('restaurants.edit', $restaurant->id) }}"
                                class="block p-6 bg-white hover:bg-orange-200 rounded-lg shadow-lg transition transform hover:scale-105">
                                <h4 class="text-xl font-semibold text-gray-800">Restaurant Info</h4>
                                <p class="mt-2 text-gray-600">Manage your restaurant information</p>
                            </a>

                            <!-- Menu Management -->
                            <a href="{{ route('menus.index') }}"
                                class="block p-6 bg-white hover:bg-orange-200 rounded-lg shadow-lg transition transform hover:scale-105">
                                <h4 class="text-xl font-semibold text-gray-800">Menus</h4>
                                <p class="mt-2 text-gray-600">Manage your menu items</p>
                            </a>

                            <!-- Order Management -->
                            <a href="{{ route('seller.orders') }}"
                                class="block p-6 bg-white hover:bg-orange-200 rounded-lg shadow-lg transition transform hover:scale-105">
                                <h4 class="text-xl font-semibold text-gray-800">Orders</h4>
                                <p class="mt-2 text-gray-600">View and manage incoming orders</p>
                            </a>
                        </div>
                    @else
                        <!-- User belum memiliki restoran -->
                        <div class="mt-4 p-6 bg-orange-100 rounded-lg">
                            <p class="text-gray-800">You need to create a restaurant first.</p>
                            <a href="{{ route('restaurants.create') }}" 
                                class="inline-flex items-center mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-700 transition">
                                Create Your Restaurant
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>