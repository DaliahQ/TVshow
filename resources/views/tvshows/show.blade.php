@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $tvshow->title }}</h1>
        <p>{{ $tvshow->description }}</p>
        <p><strong>Airing Time:</strong> {{ $tvshow->airing_time }}</p>

        <hr>

        <h3>Episodes</h3>
        <div class="list-group">
            @foreach ($tvshow->episodes as $episode)
                <a href="{{ route('episodes.show', $episode->id) }}" class="list-group-item list-group-item-action">
                    {{ $episode->title }}
                </a>
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
            @endforeach
        </div>

        <form action="#" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-secondary">Follow</button>
        </form>
    </div>
@endsection
