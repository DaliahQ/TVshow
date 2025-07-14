@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h2>Search Results for "{{ $query }}"</h2>

        <h3>Episodes</h3>
        @if ($episodes->count())
            <ul class="list-group mb-4">
                @foreach ($episodes as $episode)
                    <li class="list-group-item">
                        <a href="{{ route('episodes.show', $episode->id) }}">{{ $episode->title }}</a>
                    </li>
                @endforeach
            </ul>
            {{ $episodes->links() }}
        @else
            <p>No episodes found.</p>
        @endif

        <h3>Shows</h3>
        @if ($shows->count())
            <ul class="list-group mb-4">
                @foreach ($shows as $show)
                    <li class="list-group-item">
                        <a href="{{ route('tvshows.show', $show->id) }}">{{ $show->title }}</a>
                    </li>
                @endforeach
            </ul>
            {{ $shows->links() }}
        @else
            <p>No shows found.</p>
        @endif
    </div>
@endsection
