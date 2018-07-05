<?php

namespace AidynMakhataev\LaravelFilterable;

use Illuminate\Support\ServiceProvider;
use AidynMakhataev\LaravelFilterable\Commands\MakeFilterCommand;

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
            __DIR__.'/../config/filterable.php' => config_path('filterable.php'),
        ], 'laravelfilterable.config');  
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(MakeFilterCommand::class);
    }
    
}