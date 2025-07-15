@extends('layouts.admin')

@section('content')
    <div class="container text-white">
        <h1>Add Episode to {{ $series->title }}</h1>

        <form action="{{ route('admin.episodes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="series_id" value="{{ $series->id }}">

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

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Day</label>
                    <select name="airing_day" class="form-control" required>
                        <option value="">Select day</option>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Time</label>
                    <input type="time" name="airing_time" class="form-control" required>
                </div>
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
