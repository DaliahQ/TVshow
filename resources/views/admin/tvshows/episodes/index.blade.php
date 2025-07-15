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
                            <!-- View Button -->
                            <a href="{{ route('admin.episodes.show', $episode->id) }}" class="btn btn-info btn-sm">View</a>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.episodes.destroy', $episode->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this episode?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
