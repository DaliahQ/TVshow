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
        return view('admin.episodes.create', compact('series'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $TvId)
    {
        $series = TVShow::findOrFail($TvId);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'required',
            'airing_time' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:20000',
        ]);

        // Upload thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Upload video
        $videoPath = $request->file('video')->store('videos', 'public');

        Episode::create([
            'series_id' => $TvId,
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'airing_time' => $request->airing_time,
            'thumbnail_path' => $thumbnailPath,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('admin.tvshows.episodes', $TvId)->with('success', 'Episode created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $episode = Episode::findOrFail($id);
        return view('admin.episodes.edit', compact('episode'));
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
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20000',
        ]);

        $data = $request->only(['title', 'description', 'duration', 'airing_time']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video_path'] = $request->file('video')->store('videos', 'public');
        }

        $episode->update($data);

        return redirect()->route('admin.tvshows.episodes', $episode->series_id)->with('success', 'Episode updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
