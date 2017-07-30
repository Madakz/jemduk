<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LandServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Land\LandContract',
            'App\Repositories\Land\EloquentLandRepository');
    }
}
