<x-app-layout>
    <div class="max-w-4xl mx-auto py-12">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Edit User</h2>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <form action="{{ route('users.update', $users->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $users->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                        required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $users->email }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                        required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" id="role"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
                        <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="seller" {{ $users->role == 'seller' ? 'selected' : '' }}>Seller</option>
                        <option value="buyer" {{ $users->role == 'buyer' ? 'selected' : '' }}>Buyer</option>
                    </select>
                </div>

                <!-- Password (Optional) -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password (Optional)</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                        placeholder="Leave blank if you don't want to change">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
