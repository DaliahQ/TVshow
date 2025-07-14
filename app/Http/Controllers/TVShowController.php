<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TVShow;

class TVShowController extends Controller
{
      public function index()
    {
        $tvshows = TVShow::latest()->get();
        return view('tvshows.index', compact('tvshows'));
    }

    public function show($id)
    {
        $tvshow = TVShow::with('episodes')->findOrFail($id);
        return view('tvshows.show', compact('tvshow'));
    }
}
