@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Episodes for {{ $show->title }}</h1>
    <a href="{{ route('admin.episodes.create', $show->id) }}" class="btn btn-primary mb-3">Add New Episode</a>

    <table class="table table-bordered" id="episodesTable">
        <thead>
            <tr>
                <th>Title</th>
                <th>Airing Time</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($episodes as $episode)
            <tr>
                <td>{{ $episode->title }}</td>
                <td>{{ $episode->airing_time }}</td>
                <td>{{ $episode->duration }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


