<!-- resources/views/order_details/index.blade.php -->
<x-app-layout>
    <div class="container">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Order Details</h1>
            <div class="flex gap-4">
                <!-- Add Orders Button -->
                <a href="{{ route('orders.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-5 w-5 mr-2" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    View Orders
                </a>
                
                <!-- Existing Add Order Detail button -->
                <a href="{{ route('order_details.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-5 w-5 mr-2" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Add Order Detail
                </a>
            </div>
        </div>

        <!-- Rest of your existing table code -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- Your existing table content -->
            </table>
        </div>
    </div>
</x-app-layout>