@extends('layouts.admin')

@section('content')
<div class="container text-white py-4">
    <h1 class="mb-4">{{ $episode->title }}</h1>

    <div class="mb-3">
        <strong>Description:</strong>
        <p>{{ $episode->description }}</p>
    </div>

    <div class="mb-3">
        <strong>Duration:</strong>
        <p>{{ $episode->duration }}</p>
    </div>

    <div class="mb-3">
        <strong>Airing Schedule:</strong>
        <p>
            @php
                $airingParts = explode(' ', $episode->airing_time);
                $airingDay = $airingParts[0] ?? '';
                $airingTime = $airingParts[2] ?? '';
            @endphp

            <span class="badge bg-primary">{{ $airingDay }}</span>
            at <span class="badge bg-primary">{{ $airingTime }}</span>
        </p>
    </div>

    <div class="mb-3">
        <strong>Thumbnail:</strong><br>
        @if($episode->thumbnail)
            <img src="{{ asset('storage/' . $episode->thumbnail) }}" alt="{{ $episode->title }}" width="200">
        @else
            <p>No thumbnail uploaded.</p>
        @endif
    </div>

    <div class="mb-3">
        <strong>Video:</strong><br>
        @if($episode->video)
            <video controls width="400">
                <source src="{{ asset('storage/' . $episode->video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
            <p>No video uploaded.</p>
        @endif
    </div>

    <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="btn btn-warning">Edit Episode</a>
    <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary ms-2">Back to List</a>
</div>
@endsection
