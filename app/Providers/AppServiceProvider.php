<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TVShow;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $randomShows = TVShow::inRandomOrder()->limit(5)->get();
            $view->with('randomShows', $randomShows);
        });
    }
}
