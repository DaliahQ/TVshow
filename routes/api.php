<?php

use App\Http\Controllers\Api\EpisodeLikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FollowController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tvshows/{tvshow}/follow', [FollowController::class, 'follow']);
    Route::delete('/tvshows/{tvshow}/unfollow', [FollowController::class, 'unfollow']);
    Route::post('/episodes/{episode}/like', [EpisodeLikeController::class, 'like'])->name('api.episodes.like');
    Route::delete('/episodes/{episode}/dislike', [EpisodeLikeController::class, 'dislike'])->name('api.episodes.dislike');
});
