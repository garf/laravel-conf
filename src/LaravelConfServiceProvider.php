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
        $this->app->bindShared('conf', function ($app) {
            return new HtmlBuilder($app['url']);
        });
    }
}
