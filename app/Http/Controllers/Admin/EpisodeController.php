<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\TVShow;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create($TvId)
    {
        $series = TVShow::findOrFail($TvId);
        return view('admin.tvshows.episodes.create', compact('series'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $TvId = $request->input('series_id');
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'required',
            'airing_time' => 'required',
            'airing_day' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:20000',
        ]);
        $request['airing_time'] = $request->airing_day  . ' @ ' . date('g:i A', strtotime($request->airing_time));

        // Upload thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Upload video
        $videoPath = $request->file('video')->store('videos', 'public');

        Episode::create([
            'tv_show_id' => $TvId,
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'airing_time' => $request->airing_time,
            'thumbnail' => $thumbnailPath,
            'video' => $videoPath,
        ]);

        return redirect()->route('admin.tvshows.episodes', $TvId)->with('success', 'Episode created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $episode = Episode::findOrFail($id);
        return view('admin.tvshows.episodes.show', compact('episode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $episode = Episode::findOrFail($id);

        // Parse airing_time
        $parts = explode(' @ ', $episode->airing_time);
        $airingDay = $parts[0] ?? '';
        $airingTime = isset($parts[1]) ? date('H:i', strtotime($parts[1])) : '';

        return view('admin.tvshows.episodes.edit', compact('episode', 'airingDay', 'airingTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $episode = Episode::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'required',
            'airing_time' => 'required',
            'airing_day' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20000',
        ]);


        $request['airing_time'] = $request->airing_day .  ' @ ' . date('g:i A', strtotime($request->airing_time));

        $data = $request->only(['title', 'description', 'duration', 'airing_time', 'airing_day']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video_path'] = $request->file('video')->store('videos', 'public');
        }

        $episode->update($data);

        return redirect()->route('admin.tvshows.episodes', $episode->tv_show_id)->with('success', 'Episode updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
