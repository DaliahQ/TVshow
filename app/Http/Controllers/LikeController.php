<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;

class LikeController extends Controller
{
    public function store(Episode $episode)
    {
        auth()->user()->likedEpisodes()->attach($episode->id);
        return back();
    }

    public function destroy($episodeId)
    {
        auth()->user()->likedEpisodes()->detach($episodeId);
        return back();
    }
}
