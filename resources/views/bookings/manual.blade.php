<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📝 Manual Booking</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('bookings.manual.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" class="w-full border p-2 rounded" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Time</label>
                        <input type="time" name="time" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                        <input type="number" name="duration" class="w-full border p-2 rounded" required min="1">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Create Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
