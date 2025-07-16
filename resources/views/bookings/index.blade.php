<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📅 My Bookings
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 🔔 Success Message --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ✅ Bookings Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">📋 List of Bookings</h3>

                @if ($bookings->isEmpty())
                    <p class="text-gray-500">No bookings found.</p>
                @else
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs uppercase bg-gray-200 text-gray-600">
                            <tr>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Time</th>
                                <th class="px-4 py-2">Duration (min)</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 font-medium">{{ $booking->title }}</td>
                                    <td class="px-4 py-2">{{ $booking->date }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->time)->format('h:i A') }}</td>
                                    <td class="px-4 py-2">{{ $booking->duration }} mins</td>
                                    <td class="px-4 py-2 capitalize">
                                        <span class="px-2 py-1 rounded-full text-white text-xs
                                            {{ $booking->status == 'pending' ? 'bg-yellow-500' : ($booking->status == 'completed' ? 'bg-green-600' : 'bg-blue-500') }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 space-x-2">
                                        @can('update', $booking)
                                            <a href="{{ route('bookings.edit', $booking->id) }}"
                                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                                        @endcan

                                        @can('delete', $booking)
                                            <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
