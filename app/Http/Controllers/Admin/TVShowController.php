<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TVShow;
use Illuminate\Http\Request;

class TVShowController extends Controller
{
    public function index()
    {
        $shows = TVShow::all() ;
        return view('admin.tvshows.index', compact('shows'));
    }

    public function create()
    {
        return view('admin.tvshows.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'airing_time' => 'required',
        ]);

        TVShow::create($request->all());
        return redirect()->route('admin.tvshows.index')->with('success', 'TV Show created successfully.');
    }

    public function edit($id)
    {
        $show = TVShow::findOrFail($id);
        return view('admin.tvshows.edit', compact('show'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'airing_time' => 'required',
        ]);

        $show = TVShow::findOrFail($id);
        $show->update($request->all());
        return redirect()->route('admin.tvshows.index')->with('success', 'TV Show updated successfully.');
    }

    public function episodes($id)
    {
        $show = TVShow::findOrFail($id);
        $episodes = $show->episodes;
        return view('admin.tvshows.episodes.index', compact('show', 'episodes'));
    }
}
