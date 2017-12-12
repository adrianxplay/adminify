<?php

namespace Adrianxplay\Adminify;
use Illuminate\Support\ServiceProvider;
use Adrianxplay\Adminify\Commands\Admin;
use Adrianxplay\Adminify\Commands\PublishRoles;

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

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
          __DIR__.'/resources/assets/' => public_path('vendor/adrianxplay')
        ], 'public');


        if($this->app->runningInConsole()){
          $this->commands([
              Admin::class,
              PublishRoles::class
          ]);
        }
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
