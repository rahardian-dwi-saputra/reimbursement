<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        Gate::define('isDirektur', function($user) {
            return $user->jabatan == 'DIREKTUR' ? Response::allow() : Response::deny('Hanya DIREKTUR yang dapat mengakses halaman ini');
        });
    }
}
