<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\TVShowController;

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
Route::get('/episodes/{id}', [EpisodeController::class, 'show'])->name('episodes.show');
//Tv shows
Route::get('/tvshows', [TVShowController::class, 'index'])->name('tvshows.index');
Route::get('/tvshows/{id}', [TVShowController::class, 'show'])->name('tvshows.show');
require __DIR__.'/auth.php';
