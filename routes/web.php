<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\TVShowController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/', [EpisodeController::class, 'latest'])->name('home');
//Tv shows
Route::get('/tvshows', [TVShowController::class, 'index'])->name('tvshows.index');
Route::get('/tvshows/{id}', [TVShowController::class, 'show'])->name('tvshows.show');
// follow feature
Route::post('tvshows/{tvshow}/follow', [FollowController::class, 'store'])->name('tvshows.follow')->middleware('auth');
Route::delete('tvshows/{tvshow}/unfollow', [FollowController::class, 'destroy'])->name('tvshows.unfollow')->middleware('auth');

//search
Route::get('/search', [SearchController::class, 'results'])->name('search.results');
Route::get('/search-suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');

// episodes
Route::middleware('auth')->group(function () {
Route::get('/episodes/{id}', [EpisodeController::class, 'show'])->name('episodes.show');
// like feature
Route::post('episodes/{episode}/like', [LikeController::class, 'store'])->name('episodes.like');
Route::delete('episodes/{episode}/dislike', [LikeController::class, 'destroy'])->name('episodes.dislike');

});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
