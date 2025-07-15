<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $randomShows = \App\Models\TVShow::inRandomOrder()->limit(5)->get();
            $view->with('randomShows', $randomShows);
        });
    }
}
