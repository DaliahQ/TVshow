<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TVShowController as AdminTVShowController;
use App\Http\Controllers\Admin\EpisodeController as AdminEpisodeController;
use App\Http\Controllers\Admin\UserController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * TV Shows Routes
     */
    Route::resource('tvshows', AdminTVShowController::class);
    Route::get('tvshows/{tvshow}/episodes', [AdminTVShowController::class, 'episodes'])->name('tvshows.episodes');

    /**
     * Episodes Routes
     */
    Route::resource('episodes', AdminEpisodeController::class);
    Route::get('episodes/{episode}/edit', [AdminEpisodeController::class, 'edit'])->name('episodes.edit');
    Route::put('episodes/{episode}', [AdminEpisodeController::class, 'update'])->name('episodes.update');
    Route::get('tvshows/{tvshow}/episodes/create', [AdminEpisodeController::class, 'create'])->name('episodes.create');

    /**
     * Users Routes
     */
    Route::resource('users', UserController::class)->only(['index', 'show']);
});
