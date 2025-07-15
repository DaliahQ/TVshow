@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h2 class="mb-4 text-white">Search Results for "{{ $query }}"</h2>

        {{-- Shows Results --}}
        <h3 class="text-white">Shows</h3>
        @if ($shows->count())
            <div class="row mb-5">
                @foreach ($shows as $show)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 bg-dark text-white border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" style="font-weight: bold; font-size: 1.4rem;">
                                    <span style="color: #0d6efd;">&#9733;</span>
                                    {{ $show->title }}
                                </h5>

                                <p class="card-text text-muted mb-2" style="font-size: 0.95rem;">
                                    {{ \Illuminate\Support\Str::limit($show->description, 60) }}
                                </p>

                                <small class="text-secondary mb-1">
                                    Airing Time: {{ $show->airing_time }}
                                </small>

                                @auth
                                    <a href="{{ route('tvshows.show', $show->id) }}" class="btn btn-primary mt-auto">
                                        View Series
                                    </a>
                                @else
                                    <button class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#authModal">
                                        View Series
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $shows->links() }}
        @else
            <p class="text-white">No shows found.</p>
        @endif

        {{-- Episodes Results --}}
        <h3 class="text-white">Episodes</h3>
        @if ($episodes->count())
            <div id="episodesCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($episodes->chunk(4) as $chunkIndex => $chunk)
                        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $episode)
                                    <div class="col-md-3">
                                        <div class="card h-100 bg-dark text-white">
                                            <img
                                                src="{{ $episode->thumbnail ? asset('storage/' . $episode->thumbnail) : 'https://via.placeholder.com/150' }}"

                                            class="card-img-top" alt="{{ $episode->title }}"
                                            style="height: 150px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column text-white">
                                                <h5 class="card-title">{{ $episode->title }}</h5>
                                                <p class="card-text">
                                                    {{ \Illuminate\Support\Str::limit($episode->description, 80) }}
                                                </p>
                                                <small class="text-muted">Duration: {{ $episode->duration }}</small><br>
                                                <small class="text-muted">Airing: {{ $episode->airing_time }}</small>

                                                @auth
                                                    <a href="{{ route('episodes.show', $episode->id) }}"
                                                        class="btn btn-primary btn-sm mt-auto">Watch Now</a>
                                                @else
                                                    <button class="btn btn-primary btn-sm mt-auto" data-bs-toggle="modal"
                                                        data-bs-target="#authModal">
                                                        Watch Now
                                                    </button>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Carousel controls --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#episodesCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#episodesCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            {{ $episodes->links() }}
        @else
            <p class="text-white">No episodes found.</p>
        @endif
    </div>
@endsection
