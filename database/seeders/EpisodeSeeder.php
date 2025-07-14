<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Episode;
use App\Models\TVShow;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tvShows = TVShow::all();

        foreach ($tvShows as $tvShow) {
            Episode::factory(5)->create([
                'tv_show_id' => $tvShow->id
            ]);
        }
    }
}
