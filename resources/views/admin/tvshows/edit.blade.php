@extends('layouts.admin')

@section('content')
<div class="container  text-white">
    <h1>Edit Series</h1>
    <form action="{{ route('admin.tvshows.update', $show->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group text-white">
            <label>Title</label>
            <input type="text" name="title" value="{{ $show->title }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $show->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Airing Time</label>
            <input type="text" name="airing_time" value="{{ $show->airing_time }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
