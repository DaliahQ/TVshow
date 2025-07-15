@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Episode: {{ $episode->title }}</h1>

    <form action="{{ route('admin.episodes.update', $episode->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ $episode->title }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $episode->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Duration</label>
            <input type="text" name="duration" value="{{ $episode->duration }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Airing Time</label>
            <input type="text" name="airing_time" value="{{ $episode->airing_time }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
            <small>Current: <img src="{{ asset('storage/'.$episode->thumbnail_path) }}" width="100"></small>
        </div>

        <div class="form-group">
            <label>Video</label>
            <input type="file" name="video" class="form-control">
            <small>Current Video: {{ $episode->video_path }}</small>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update Episode</button>
    </form>
</div>
@endsection
