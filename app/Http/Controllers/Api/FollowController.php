<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TVShow;;
class FollowController extends Controller
{
    public function follow(TVShow $tvshow)
    {
        auth()->user()->follows()->attach($tvshow->id);

        return response()->json([
            'message' => 'Followed successfully',
            'followed' => true,
        ]);
    }

    public function unfollow(TVShow $tvshow)
    {
        auth()->user()->follows()->detach($tvshow->id);

        return response()->json([
            'message' => 'Unfollowed successfully',
            'followed' => false,
        ]);
    }
}
