<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episode;

class EpisodeLikeController extends Controller
{
    public function like(Episode $episode)
    {
        $episode->likers()->syncWithoutDetaching([auth()->id()]);
        return response()->json(['liked' => true]);
    }

    public function dislike(Episode $episode)
    {
        $episode->likers()->detach(auth()->id());
        return response()->json(['liked' => false]);
    }
}
