<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Override the default pagination since for Bulma.
        Paginator::defaultView('pagination.bulma');
        Paginator::defaultSimpleView('pagination.simple-bulma');

        // Force HTTPS if this isn't a local deployment.
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
