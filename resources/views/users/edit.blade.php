<x-layout>
    <h1 class="text-xl font-bold mb-4">Edit Profile</h1>

    <!-- Update Profile Form -->
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-bold text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-bold text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-bold text-gray-700">New Password</label>
            <input type="password" id="password" name="password" placeholder="Leave blank to keep current password"
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-bold text-gray-700">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Leave blank to keep current password"
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div class="text-center">
            <button type="submit"
                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                Update Profile
            </button>
        </div>
    </form>

    <!-- Delete Account Section -->
    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
        @csrf
        @method('DELETE')

        <div class="text-center mt-8">
            <button type="submit"
                class="transition-colors duration-300 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full">
                Delete Account
            </button>
            @if (session('success'))
            <div class="bg-green-500 text-white text-center py-4 px-6 mb-4">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </form>
</x-layout>