@extends('layouts.admin')

{{-- @section('title', 'Dashboard') --}}

@section('content')
    <div class="container text-white bg-dark min-vh-100 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Admin Dashboard</h1>
            <div>
                <a href="{{ url('/') }}" class="btn btn-secondary">Go to Website</a>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
{{-- 
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark">
                <a href="{{ route('admin.tvshows.index') }}" class="text-white">Manage TV Shows</a>
            </li>
            <li class="list-group-item bg-dark">
                <a href="{{ route('admin.episodes.index') }}" class="text-white">Manage Episodes</a>
            </li>
            <li class="list-group-item bg-dark">
                <a href="{{ route('admin.users.index') }}" class="text-white">View Users</a>
            </li>
        </ul> --}}
    </div>

    <script>
        const toggle = document.getElementById('darkModeToggle');
        toggle.addEventListener('click', function() {
            document.body.classList.toggle('bg-dark');
            document.body.classList.toggle('text-white');
        });
    </script>
@endsection
