<x-guest-layout>
    <h2 class="text-xl font-semibold text-center mb-4">Create Account</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>

        <div>
            <button type="submit"
                class="w-full bg-gray-800 text-white font-semibold py-2 px-4 rounded hover:bg-gray-700">
                Register
            </button>
        </div>

        <div class="text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
        </div>
    </form>
</x-guest-layout>
