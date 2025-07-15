@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1 class="text-2xl font-bold mb-4">{{ $episode->title }}</h1>

    <img src="{{ asset('storage/' . $episode->thumbnail) }}" alt="{{ $episode->title }}"
        class="mb-4 w-full h-24 object-cover">

    <p>{{ $episode->description }}</p>
    <p class="text-sm text-gray-500">Duration: {{ $episode->duration }}</p>
    <p class="text-sm text-gray-500">Airing Time: {{ $episode->airing_time }}</p>

    @auth
        <button id="like-btn"
            class="btn {{ $episode->isLikedByAuthUser() ? 'btn-danger' : 'btn-primary' }} text-white px-4 py-2 rounded"
            data-liked="{{ $episode->isLikedByAuthUser() ? 'true' : 'false' }}">
            {{ $episode->isLikedByAuthUser() ? 'Dislike' : 'Like' }}
        </button>
    @endauth

    @if ($episode->video)
        <video controls class="w-full mt-4">
            <source src="{{ asset('storage/' . $episode->video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else
        <p>No video uploaded.</p>
    @endif
</div>
@endsection

@push('scripts')
<script>
const apiToken = @json(auth()->user()?->currentAccessToken()?->plainTextToken
    ?? auth()->user()?->createToken('token-name')->plainTextToken
    ?? '');

$(document).ready(function() {
    $('#like-btn').click(function() {
        let btn = $(this);
        let isLiked = btn.data('liked') === 'true';
        let episodeId = '{{ $episode->id }}';
        let baseUrl = "{{ url('api') }}";
        let url = baseUrl + '/episodes/' + episodeId + (isLiked ? '/dislike' : '/like');

        $.ajax({
            url: url,
            type: isLiked ? 'DELETE' : 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + apiToken
            },
            success: function(response) {
                if (response.liked) {
                    btn.removeClass('btn-primary').addClass('btn-danger').text('Dislike');
                    btn.data('liked', 'true');
                } else {
                    btn.removeClass('btn-danger').addClass('btn-primary').text('Like');
                    btn.data('liked', 'false');
                }
            },
            error: function(xhr) {
                alert('Error: ' + (xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Something went wrong'));
            }
        });
    });
});
</script>
@endpush
