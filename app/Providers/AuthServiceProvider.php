<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("admin", function(User $user){
            return $user->hasRole("Admin");

        });

        Gate::define("manager", function(User $user){
            return $user->hasRole("Manager");
            
        });
 
        Gate::define("employe", function(User $user){
            return $user->hasRole("Employe");
            
        });

        Gate::after(function(User $user){
           return $user->hasRole("Super Admin");
        });
    }
}
