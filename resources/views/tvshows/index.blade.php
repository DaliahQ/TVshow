@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-white">TV Shows</h1>

    <div class="row">
        @foreach($tvshows as $show)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $show->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($show->description, 100) }}</p>
                        <p class="card-text"><small class="text-muted">{{ $show->airing_time }}</small></p>
                        <a href="{{ route('tvshows.show', $show->id) }}" class="btn btn-primary">View Series</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
