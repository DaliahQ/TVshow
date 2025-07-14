@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-white">TV Shows</h1>

        <div class="row">
            @foreach ($tvshows as $show)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-dark text-white border-0">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="font-weight: bold; font-size: 1.4rem;">
                                <span style="color: #0d6efd;">&#9733;</span> <!-- star icon -->
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
    </div>
@endsection
