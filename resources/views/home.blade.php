@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4 text-white">Latest Episodes</h1>

        <div class="row">
            @forelse ($episodes as $episode)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-dark text-white border-0">
                        <img src="{{ $episode->thumbnail }}" class="card-img-top" alt="{{ $episode->title }}"
                            style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $episode->title }}</h5>
                            <p class="card-text text-muted mb-1">
                                {{ \Illuminate\Support\Str::limit($episode->description, 60) }}</p>
                            <small class="text-secondary">Duration: {{ $episode->duration }}</small><br>
                            <small class="text-secondary">Airing: {{ $episode->airing_time }}</small>

                            @auth
                                <a href="{{ route('episodes.show', $episode->id) }}" class="btn btn-primary mt-auto">Watch
                                    Now</a>
                            @else
                                <button class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#authModal">
                                    Watch Now
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-white">No episodes found.</p>
            @endforelse
        </div>
    </div>
@endsection
