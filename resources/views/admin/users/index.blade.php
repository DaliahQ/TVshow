@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
