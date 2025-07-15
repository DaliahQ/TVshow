@extends('layouts.admin')

@section('content')
    <div class="container text-white">
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

            {{-- <div class="form-group">
                <label>Airing Time</label>
                <input type="text" name="airing_time" class="form-control" required
                    placeholder="Ex Monday-Thursday @ 8:30PM">
            </div> --}}
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>From Day</label>
                    <select name="from_day" class="form-control" required>
                        <option value="">Select day</option>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label>To Day</label>
                    <select name="to_day" class="form-control" required>
                        <option value="">Select day</option>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label>Time</label>
                    <input type="time" name="time" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>
@endsection
