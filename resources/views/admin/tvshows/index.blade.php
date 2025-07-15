@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>All TV Shows</h1>
    <a href="{{ route('admin.tvshows.create') }}" class="btn btn-primary mb-3">Add New TV Show</a>

    <table class="table table-bordered" id="showsTable">
        <thead>
            <tr>
                <th>Title</th>
                <th>Airing Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shows as $show)
            <tr>
                <td>{{ $show->title }}</td>
                <td>{{ $show->airing_time }}</td>
                <td>
                    <a href="{{ route('admin.tvshows.edit', $show->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('admin.tvshows.episodes', $show->id) }}" class="btn btn-info btn-sm">Manage Episodes</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


