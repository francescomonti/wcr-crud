<?php

namespace Wcr\Crud;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Ability;

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
        $this->publishes([__DIR__ . '/models' => $this->app->basePath() . '/app'], 'abilities');
        
        $this->loadViewsFrom(__DIR__.'/resources/views', 'WcrCrud');

        Blade::if('iCan', function ($action, $entity) {
            return Ability::$action($entity);
        });
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
