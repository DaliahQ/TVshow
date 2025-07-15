<?php

namespace App\Http\Controllers;

use App\Models\Episode;

use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function latest()
    {
        $episodes = Episode::with('tvShow')->latest()->take(12)->get();
        return view('home', compact('episodes'));
    }

    public function show($id)
    {
        $episode = Episode::findOrFail($id);
        return view('episodes.show', compact('episode'));
    }

    

}
