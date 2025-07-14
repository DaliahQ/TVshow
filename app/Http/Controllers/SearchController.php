<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\TVShow;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return '';
        }

        $episodes = Episode::where('title', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title']);

        $shows = TVShow::where('title', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title']);

        return view('partials.search_suggestions', compact('episodes', 'shows'))->render();
    }

    public function results(Request $request)
    {
        $query = $request->get('q', '');

        $episodes = Episode::where('title', 'like', "%{$query}%")->paginate(10);
        $shows = TVShow::where('title', 'like', "%{$query}%")->paginate(10);

        return view('search.results', compact('episodes', 'shows', 'query'));
    }
}
