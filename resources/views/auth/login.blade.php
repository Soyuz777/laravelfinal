<x-guest-layout>
    <h2 class="text-xl font-semibold text-center mb-4">Log In</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="border-gray-300 rounded text-blue-600 shadow-sm focus:ring-blue-500">
            <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
        </div>

        <div>
            <button type="submit"
                class="w-full bg-gray-800 text-white font-semibold py-2 px-4 rounded hover:bg-gray-700">
                Log in
            </button>
        </div>

        @if (Route::has('password.request'))
            <div class="text-right text-sm">
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                    Forgot your password?
                </a>
            </div>
        @endif

        <div class="text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        </div>
    </form>
</x-guest-layout>
