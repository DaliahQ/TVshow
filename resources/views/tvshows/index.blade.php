@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-white">TV Shows</h1>

        <div class="row">
            @foreach ($tvshows as $show)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $show->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($show->description, 100) }}</p>
                            <p class="card-text"><small class="text-muted">{{ $show->airing_time }}</small></p>
                            @auth
                                <a href="{{ route('tvshows.show', $show->id) }}" class="btn btn-primary">View Series</a>
                            @else
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authModal">
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

<!-- Auth Modal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">Please Login or Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                            type="button" role="tab">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                            type="button" role="tab">Sign Up</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        @include('auth.partials.login-form')

                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel">
                        @include('auth.partials.register-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
