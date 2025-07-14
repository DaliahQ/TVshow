@extends('layouts.app')

@section('content')
    <div class="container mt-4 text-white">
        <h1>{{ $tvshow->title }}</h1>
        <p>{{ $tvshow->description }}</p>
        <p><strong>Airing Time:</strong> {{ $tvshow->airing_time }}</p>

        @auth
            @if (auth()->user()->follows->contains($tvshow->id))
                <form action="{{ route('tvshows.unfollow', $tvshow) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Unfollow</button>
                </form>
            @else
                <form action="{{ route('tvshows.follow', $tvshow) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
            @endif
        @endauth

        <hr>

        <h3>Episodes</h3>
        <div id="episodesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($tvshow->episodes->chunk(4) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $episode)
                                <div class="col-md-3">
                                    <div class="card h-100 bg-dark text-white">
                                        <img src="{{ $episode->thumbnail ?? 'https://via.placeholder.com/150' }}"
                                            class="card-img-top" alt="{{ $episode->title }}"
                                            style="height: 150px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $episode->title }}</h5>
                                            <p class="card-text">
                                                {{ \Illuminate\Support\Str::limit($episode->description, 80) }}</p>
                                            <small class="text-muted">Duration: {{ $episode->duration }}</small><br>
                                            <small class="text-muted">Airing: {{ $episode->airing_time }}</small>

                                            @auth
                                                <a href="{{ route('episodes.show', $episode->id) }}"
                                                    class="btn btn-primary btn-sm mt-auto">Watch Now</a>
                                            @else
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#authModal">
                                                    View Series
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
            <button class="carousel-control-prev" type="button" data-bs-target="#episodesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#episodesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

    </div>
@endsection
<style>
    .card {
        height: auto !important;
        max-width: 220px;
        margin: 0 auto 15px auto;
    }

    .card-img-top {
        height: 120px !important;
        object-fit: cover;
    }

    .card-body {
        padding: 0.5rem 1rem;
    }

    #episodesCarousel {
        position: relative;
        padding-top: 50px;
    }

    #episodesCarousel .carousel-control-prev,
    #episodesCarousel .carousel-control-next {
        position: absolute;
        top: 0;
        transform: none;
        width: 40px;
        height: 40px;
        opacity: 1;
    }

    #episodesCarousel .carousel-control-prev {
        left: 45%;
    }

    #episodesCarousel .carousel-control-next {
        right: 45%;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-size: 30px 30px;
    }
</style>
