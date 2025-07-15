<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TVShow;
use Illuminate\Http\Request;

class TVShowController extends Controller
{
    public function index()
    {
        $shows = TVShow::all();
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
            'from_day' => 'required|string',
            'to_day' => 'required|string',
            'time' => 'required',
        ]);

        $request['airing_time'] = $request->from_day . '-' . $request->to_day . ' @ ' . date('g:i A', strtotime($request->time));


        TVShow::create($request->all());
        return redirect()->route('admin.tvshows.index')->with('success', 'TV Show created successfully.');
    }

    public function edit($id)
    {

        $show = TVShow::findOrFail($id);

        // Parse airing_time
        $parts = explode(' @ ', $show->airing_time);
        $days = explode('-', $parts[0]);
        $from_day = $days[0] ?? '';
        $to_day = $days[1] ?? '';
        $time = isset($parts[1]) ? date('H:i', strtotime($parts[1])) : '';

        return view('admin.tvshows.edit', compact('show', 'from_day', 'to_day', 'time'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'from_day' => 'required|string',
            'to_day' => 'required|string',
            'time' => 'required',
        ]);


        $request['airing_time'] = $request->from_day . '-' . $request->to_day . ' @ ' . date('g:i A', strtotime($request->time));


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

    public function show($id)
    {
        $show = TVShow::findOrFail($id);
        return view('admin.tvshows.show', compact('show'));
    }
}
