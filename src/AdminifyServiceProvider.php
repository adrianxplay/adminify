<?php

namespace Adrianxplay\Adminify;

use Illuminate\Support\ServiceProvider;

class AdminifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes/web.php';

        $this->publishes([
          __DIR__.'/resources/assets/' => public_path('vendor/adrianxplay')
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__."/resources/views", "adminify");
    }
}
