@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add Episode to {{ $series->title }}</h1>

    <form action="{{ route('admin.episodes.store', $series->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Duration</label>
            <input type="text" name="duration" class="form-control" required placeholder="Ex 45 min">
        </div>

        <div class="form-group">
            <label>Airing Time</label>
            <input type="text" name="airing_time" class="form-control" required placeholder="Ex Monday @ 8:30 PM">
        </div>

        <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Video</label>
            <input type="file" name="video" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Save Episode</button>
    </form>
</div>
@endsection
