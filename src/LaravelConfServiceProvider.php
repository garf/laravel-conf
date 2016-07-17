<?php

namespace Garf\LaravelConf;

use Garf\LaravelConf\Contracts\ConfContract;
use Illuminate\Support\ServiceProvider;

class LaravelConfServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__.'/../config/laravel-conf.php' => config_path('laravel-conf.php'),
        ], 'config');

        $this->app->singleton('conf', function ($app) {
            return new ConfManager($app);
        });

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        require_once __DIR__.'/helper.php';
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ConfContract::class];
    }
}
