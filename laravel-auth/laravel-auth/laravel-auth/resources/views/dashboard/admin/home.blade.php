<!-- resources/views/dashboard/admin/home.blade.php -->
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Overview</h2>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Users Stats -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-600 bg-opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4 text-white">
                                <h4 class="text-lg font-semibold">Total Users</h4>
                                <p class="text-3xl font-bold">{{ $userCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span>Buyers: {{ $buyerCount }}</span>
                            <span>Sellers: {{ $sellerCount }}</span>
                        </div>
                    </div>
                </div>

                <!-- Restaurants Stats -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-green-500 to-green-600">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-600 bg-opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="ml-4 text-white">
                                <h4 class="text-lg font-semibold">Total Restaurants</h4>
                                <p class="text-3xl font-bold">{{ $restaurantCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span>Open: {{ $openRestaurantCount }}</span>
                            <span>Closed: {{ $closedRestaurantCount }}</span>
                        </div>
                    </div>
                </div>

                <!-- Menus Stats -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-purple-500 to-purple-600">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-600 bg-opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="ml-4 text-white">
                                <h4 class="text-lg font-semibold">Total Menus</h4>
                                <p class="text-3xl font-bold">{{ $menuCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span>Available: {{ $availableMenuCount }}</span>
                            <span>Unavailable: {{ $unavailableMenuCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latest Restaurants</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latest Menus</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Latest Users</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">
                                    @foreach($latestRestaurants as $restaurant)
                                        <div class="mb-2">
                                            <p class="font-medium text-gray-800">{{ $restaurant->nama_restaurant }}</p>
                                            <p class="text-sm text-gray-500">{{ $restaurant->created_at->diffForHumans() }}</p>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    @foreach($latestMenus as $menu)
                                        <div class="mb-2">
                                            <p class="font-medium text-gray-800">{{ $menu->nama_menu }}</p>
                                            <p class="text-sm text-gray-500">{{ $menu->created_at->diffForHumans() }}</p>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    @foreach($latestUsers as $user)
                                        <div class="mb-2">
                                            <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>