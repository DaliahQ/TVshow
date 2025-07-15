<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TVShowController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\UserController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tvshows', TVShowController::class);
    Route::resource('episodes', EpisodeController::class);
    Route::resource('users', UserController::class)->only(['index', 'show']);
});
