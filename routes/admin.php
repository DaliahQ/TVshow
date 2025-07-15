<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController ;
use App\Http\Controllers\Admin\TVShowController as AdminTVShowController;
use App\Http\Controllers\Admin\EpisodeController as EpisodeController;
use App\Http\Controllers\Admin\UserController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tvshows', AdminTVShowController::class);
    Route::get('tvshows/{tvshow}/episodes', [AdminTVShowController::class, 'episodes'])->name('tvshows.episodes');
    Route::get('tvshows/{tvshow}/episodes/create', [EpisodeController::class, 'create'])->name('episodes.create');
    Route::get('episodes/{episode}/edit', [EpisodeController::class, 'edit'])->name('episodes.edit');
    Route::put('episodes/{episode}', [EpisodeController::class, 'update'])->name('episodes.update');
    Route::resource('episodes', EpisodeController::class);
    Route::resource('users', UserController::class)->only(['index', 'show']);
});
