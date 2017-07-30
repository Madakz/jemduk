<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LandlordServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Landlord\LandlordContract',
            'App\Repositories\Landlord\EloquentLandlordRepository');
    }
}
