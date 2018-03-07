<?php

namespace Wcr\Crud;

use Illuminate\Support\ServiceProvider;

class CrudServicesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([__DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'], 'migrations');
        
        $this->loadViewsFrom(__DIR__.'/resources/views', 'WcrCrud');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
