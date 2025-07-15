@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add New Series</h1>
        <form action="{{ route('admin.tvshows.store') }}" method="POST">
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
                <label>Airing Time</label>
                <input type="text" name="airing_time" class="form-control" required
                    placeholder="Ex Monday-Thursday @ 8:30PM">
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>
@endsection
