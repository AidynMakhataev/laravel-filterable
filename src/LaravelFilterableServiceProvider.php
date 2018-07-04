<?php

namespace AidynMakhataev\LaravelFilterable;

use Illuminate\Support\ServiceProvider;

class LaravelFilterableServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravelfilterable.php' => config_path('laravelfilterable.php'),
        ], 'laravelfilterable.config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}