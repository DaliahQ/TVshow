@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 text-white">Latest Episodes</h1>

    <div class="row">
        @forelse ($episodes as $episode)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $episode->thumbnail }}" class="card-img-top" alt="{{ $episode->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $episode->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($episode->description, 100) }}</p>
                        <small class="text-muted">Duration: {{ $episode->duration }}</small><br>
                        <small class="text-muted">Airing: {{ $episode->airing_time }}</small>
                        <a href="{{ route('episodes.show', $episode->id) }}" class="btn btn-primary mt-auto">Watch Now</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No episodes found.</p>
        @endforelse
    </div>
</div>
@endsection
