<?php

namespace Ronan\plugin;

use Illuminate\Support\ServiceProvider;
use Ronan\plugin\Models\Config;
use Ronan\plugin\Repositories\Contracts\ConfigRepository;
use Ronan\plugin\Repositories\EloquentConfigRepository;


class PluginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'plugin');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
    public function register()
    {
        /**
         * Instanciando repositories
         */
        $this->app->bind( ConfigRepository::class, function () {
            return new EloquentConfigRepository( new Config() );
        } );
    }
}
