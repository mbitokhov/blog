<?php

namespace App\Providers;

use Route;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
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
        $this->registerRouter();
        $this->registerCache();
    }

    public function registerRouter()
    {
        Route::macro('getActive', function ($route) {
            return $route === $this->currentRouteName() ? 'is-active' : '';
        });
    }

    public function registerCache()
    {
        CacheRepository::macro('fileBasedRemember', function ($filename, $append, $function) {
            $key = 'fileBasedRemember_'.$append.'_'.$filename;

            $modified = filemtime($filename);
            $cached = $this->get($key);

            if ($cached === null || $cached['time'] != $modified) {
                $cached = [
                    'value' => $function($filename, $append),
                    'time' => $modified
                ];

                $this->forever($key, $cached);
            }

            return $cached['value'];
        });
    }
}
