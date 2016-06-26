<?php

namespace Gaaarfild\LaravelConf;

use Gaaarfild\LaravelConf\ConfManager;
use Gaaarfild\LaravelConf\Contracts\ConfContract;
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

        $this->app->singleton(\Gaaarfild\LaravelConf\Contracts\Factory::class, function ($app) {
            return new ConfManager($app);
        });
//
//        $this->app->singleton('conf', function ($app) {
//            return new Conf($app['url']);
//        });
//
//        $this->app->alias('conf', ConfManager::class);
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
