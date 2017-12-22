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
        define('__APPNAMESPACE__', config('adminify.app_namespace'));

        include __DIR__.'/routes/web.php';
        include __DIR__.'/helpers/helper.php';

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
          __DIR__.'/resources/assets/' => public_path('vendor/adrianxplay')
        ], 'public');

        $this->publishes([
          __DIR__.'/config/adminify.php' => config_path('adminify.php')
        ]);


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
