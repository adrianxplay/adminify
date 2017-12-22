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
          dd(Request::all());
          if($user->role->slug === "root")
            return true;

          $role_permissions = $user->role->permissions;

          dd($role_permissions);

          // $role_permissions = $ro

        });

        Gate::define('create-model', function($user){
          if($user->role->slug === "root")
            return true;
        });
        Gate::define('read-model', function($user){
          if($user->role->slug === "root")
            return true;
        });
        Gate::define('update-model', function($user){
          if($user->role->slug === "root")
            return true;
        });
        Gate::define('delete-model', function($user){
          if($user->role->slug === "root")
            return true;
        });
    }
}
