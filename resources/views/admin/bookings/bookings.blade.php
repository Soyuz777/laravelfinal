@extends('layouts.app')
@section('content')
<h1 class="text-xl font-bold mb-4">📅 Manage All Bookings</h1>

<form method="POST" action="{{ route('bookings.store') }}">
    @csrf
    <input name="title" placeholder="Title" class="border p-2 mb-2 w-full" required>
    <textarea name="details" placeholder="Details" class="border p-2 mb-2 w-full"></textarea>
    <input type="date" name="date" class="border p-2 mb-2 w-full">
    <input type="time" name="time" class="border p-2 mb-4 w-full">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Booking</button>
</form>

<ul class="mt-6 space-y-3">
    @foreach ($bookings as $booking)
        <li class="border p-3 rounded">
            <strong>{{ $booking->title }}</strong> - {{ $booking->user->name ?? 'Unknown' }}
            <div class="text-sm text-gray-500">{{ $booking->date }} {{ $booking->time }}</div>
        </li>
    @endforeach
</ul>
@endsection
