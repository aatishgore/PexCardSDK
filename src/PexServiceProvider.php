<?php

namespace aatish\Pex;

use Illuminate\Support\ServiceProvider;
use aatish\Pex\Services\PexService;

class PexServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config' => base_path('config/'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('aatish\Pex\Services\PexService', function ($app) {
            return new PexService();
          });
    }
}
