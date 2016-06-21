<?php

namespace Gaaarfild\LaravelConf;

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
        $this->registerLaravelConf();
        $this->app->alias('conf', \Gaaarfild\LaravelConf\Conf::class);
    }

    private function registerLaravelConf()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-conf.php' => config_path('laravel-conf.php'),
        ], 'config');

        $this->app->singleton('conf', function ($app) {
            return new Conf($app['url']);
        });
    }
}
