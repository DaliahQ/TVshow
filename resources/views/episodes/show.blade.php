@extends('layouts.app')

@section('content')
    <div class="container text-white">
        <h1 class="text-2xl font-bold mb-4">{{ $episode->title }}</h1>
        <img src="{{ asset('storage/' . $episode->thumbnail) }}" alt="{{ $episode->title }}" class="mb-4 w-full h-64 object-cover">
        <p>{{ $episode->description }}</p>
        <p class="text-sm text-gray-500">Duration: {{ $episode->duration }}</p>
        <p class="text-sm text-gray-500">Airing Time: {{ $episode->airing_time }}</p>
        @if ($episode->isLikedByAuthUser())
            <form action="{{ route('episodes.dislike', $episode->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger text-white px-4 py-2 rounded">Dislike</button>
            </form>
        @else
            <form action="{{ route('episodes.like', $episode->id) }}" method="POST" class="mt-4">
                @csrf
                <button class="btn btn-primary text-white px-4 py-2 rounded">Like</button>
            </form>
        @endif
        <video controls class="w-full mt-4">
            <source src="{{ $episode->video_url }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>


    </div>
@endsection
