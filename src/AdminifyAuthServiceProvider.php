<?php

namespace Adrianxplay\Adminify;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Request;

class AdminifyAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('read-dashboard', function($user){
          if($user->role->slug === "root")
            return true;

          return $user->isAllowedTo('dashboard');
        });

        Gate::define('create-model', function($user){
          if($user->role->slug === "root")
            return true;

          $path = explode("/", Request::path());
          $slug = $path[1];

          return $user->isAllowedTo("$slug.create");
        });

        Gate::define('read-model', function($user){
          if($user->role->slug === "root")
            return true;

          $path = explode("/", Request::path());
          $slug = $path[1];

          return $user->isAllowedTo("$slug.read");
        });

        Gate::define('update-model', function($user){
          if($user->role->slug === "root")
            return true;

          $path = explode("/", Request::path());
          $slug = $path[1];

          return $user->isAllowedTo("$slug.update");
        });

        Gate::define('delete-model', function($user){
          if($user->role->slug === "root")
            return true;

          $path = explode("/", Request::path());
          $slug = $path[1];

          return $user->isAllowedTo("$slug.delete");
        });
    }
}
