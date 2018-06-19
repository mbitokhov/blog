<?php

namespace App\Providers;

use Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Route::macro('getActive', function ($route) {
            return $route === $this->currentRouteName() ? 'is-active' : '';
        });
    }
}
