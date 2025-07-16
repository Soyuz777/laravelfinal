<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👥 Manage Users
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <div class="bg-white shadow p-6 rounded">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b">
                            <td class="p-2">{{ $user->name }}</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2 text-center">
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="p-4 text-center text-gray-500">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
