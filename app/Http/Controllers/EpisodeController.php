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

    public function edit($id)
    {
        $episode = Episode::findOrFail($id);
        return view('admin.episodes.edit', compact('episode'));
    }

    public function update(Request $request, $id)
    {
        $episode = Episode::findOrFail($id);
        $episode->update($request->all());
        return redirect()->route('admin.episodes.index')->with('success', 'Episode updated successfully.');
    }

    public function destroy($id)
    {
        $episode = Episode::findOrFail($id);
        $episode->delete();
        return redirect()->route('admin.episodes.index')->with('success', 'Episode deleted successfully.');
    }

    public function index()
    {
        $episodes = Episode::all();
        return view('admin.episodes.index', compact('episodes'));
    }

    public function create()
    {
        return view('admin.episodes.create');
    }

    public function store(Request $request)
    {
        Episode::create($request->all());
        return redirect()->route('admin.episodes.index')->with('success', 'Episode created successfully.');
    }
}
