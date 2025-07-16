@extends('layouts.app')
@section('content')
<h1 class="text-xl font-bold mb-4">👥 Manage Users</h1>

<ul class="space-y-3">
    @foreach ($users as $user)
        <li class="border p-3 rounded">
            <strong>{{ $user->name }}</strong> ({{ $user->email }})
            @if($user->isAdmin())
                <span class="text-green-600 ml-2 font-semibold">[Admin]</span>
            @endif
        </li>
    @endforeach
</ul>
@endsection
