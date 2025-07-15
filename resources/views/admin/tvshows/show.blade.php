@extends('layouts.admin')

@section('content')
<div class="container text-white py-4">
    <h1 class="mb-4">{{ $show->title }}</h1>

    <div class="mb-3">
        <strong>Description:</strong>
        <p>{{ $show->description }}</p>
    </div>

    <div class="mb-3">
        <strong>Airing Schedule:</strong>
        <p>
            From <span class="badge bg-primary">{{ $show->from_day }}</span>
            to <span class="badge bg-primary">{{ $show->to_day }}</span>
            at <span class="badge bg-primary">{{ \Carbon\Carbon::parse($show->time)->format('h:i A') }}</span>
        </p>
    </div>

    <a href="{{ route('admin.tvshows.edit', $show->id) }}" class="btn btn-warning">Edit Series</a>
    <a href="{{ route('admin.tvshows.index') }}" class="btn btn-secondary ms-2">Back to List</a>
</div>
@endsection
