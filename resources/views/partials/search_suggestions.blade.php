@if($episodes->count() || $shows->count())
    @foreach($episodes as $episode)
        <li class="list-group-item">
            <a href="{{ route('episodes.show', $episode->id) }}">{{ $episode->title }} <small>(Episode)</small></a>
        </li>
    @endforeach

    @foreach($shows as $show)
        <li class="list-group-item">
            <a href="{{ route('tvshows.show', $show->id) }}">{{ $show->title }} <small>(Show)</small></a>
        </li>
    @endforeach
@else
    <li class="list-group-item text-muted">No results found</li>
@endif
