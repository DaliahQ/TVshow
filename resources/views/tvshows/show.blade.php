@extends('layouts.app')

@section('content')
    <div class="container mt-4 text-white">
        <h1>{{ $tvshow->title }}</h1>
        <p>{{ $tvshow->description }}</p>
        <p><strong>Airing Time:</strong> {{ $tvshow->airing_time }}</p>

        @auth
            <button id="follow-btn"
                class="btn {{ auth()->user()->follows->contains($tvshow->id) ? 'btn-danger' : 'btn-primary' }}"
                data-following="{{ auth()->user()->follows->contains($tvshow->id) ? 'true' : 'false' }}">
                {{ auth()->user()->follows->contains($tvshow->id) ? 'Unfollow' : 'Follow' }}
            </button>
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
                                        <img src="{{ $episode->thumbnail ? asset('storage/' . $episode->thumbnail) : 'https://via.placeholder.com/150' }}"
                                            class="card-img-top" alt="{{ $episode->title }}"
                                            style="height: 150px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $episode->title }}</h5>
                                            <p class="card-text text-white">
                                                {{ \Illuminate\Support\Str::limit($episode->description, 80) }}
                                            </p>
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

@push('styles')
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
@endpush

@push('scripts')
    <script>
        const apiToken = @json(auth()->user()?->currentAccessToken()?->plainTextToken ??
                (auth()->user()?->createToken('token-name')->plainTextToken ?? ''));

        $(document).ready(function() {
            $('#follow-btn').click(function() {
                let btn = $(this);
                let isFollowing = btn.data('following') === 'true';
                let tvshowId = '{{ $tvshow->id }}';
                let apiBase =
                "{{ url('api') }}"; // will include base path, eg http://localhost/myapp/api

                let url = apiBase + '/tvshows/' + tvshowId + (isFollowing ? '/unfollow' : '/follow');
                $.ajax({
                    url: url,
                    type: isFollowing ? 'DELETE' : 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + apiToken
                    },
                    success: function(response) {
                        if (response.followed) {
                            btn.removeClass('btn-primary').addClass('btn-danger').text(
                                'Unfollow');
                            btn.data('following', 'true');
                        } else {
                            btn.removeClass('btn-danger').addClass('btn-primary').text(
                            'Follow');
                            btn.data('following', 'false');
                        }
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON && xhr.responseJSON.message ? xhr
                            .responseJSON.message : 'Something went wrong'));
                    }
                });
            });
        });
    </script>
@endpush
