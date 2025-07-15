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

            {{-- <div class="form-group">
            <label>Airing Time</label>
            <input type="text" name="airing_time" value="{{ $show->airing_time }}" class="form-control" required>
        </div> --}}
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>From Day</label>
                    <select name="from_day" class="form-control" required>
                        <option value="">Select day</option>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}" {{ $from_day == $day ? 'selected' : '' }}>
                                {{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label>To Day</label>
                    <select name="to_day" class="form-control" required>
                        <option value="">Select day</option>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}" {{ $to_day == $day ? 'selected' : '' }}>{{ $day }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label>Time</label>
                    <input type="time" name="time" value="{{ $time }}" class="form-control" required>
                </div>
            </div>


            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
