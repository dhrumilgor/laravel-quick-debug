<?php

namespace Dhr\Finderror;

use Illuminate\Support\ServiceProvider;

class FindErrorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         // register our controller
    $this->app->make('Dhr\Finderror\FinderrorController');
    $this->loadViewsFrom(__DIR__.'/view', 'finderror');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';

    }
}
