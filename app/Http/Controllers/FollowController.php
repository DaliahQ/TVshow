<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TVShow;

class FollowController extends Controller
{
    public function store(TVShow $tvshow)
    {
        auth()->user()->follows()->attach($tvshow->id);
        return back()->with('success', 'Followed successfully.');
    }

    public function destroy(TVShow $tvshow)
    {
        auth()->user()->follows()->detach($tvshow->id);
        return back()->with('success', 'Unfollowed successfully.');
    }
}
