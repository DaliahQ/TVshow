@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-4">Admin Dashboard</h1>
        <ul>
            <li><a href="{{ route('admin.tvshows.index') }}">Manage TV Shows</a></li>
            <li><a href="{{ route('admin.episodes.index') }}">Manage Episodes</a></li>
            <li><a href="{{ route('admin.users.index') }}">View Users</a></li>
        </ul>
    </div>
@endsection
