<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Reimbursement;

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

        Gate::define('isFinance', function($user) {
            return $user->jabatan == 'FINANCE' ? Response::allow() : Response::deny('Hanya FINANCE yang dapat mengakses halaman ini');
        });

        Gate::define('access-reimbursement', function ($user, Reimbursement $reimbursement) {
            return $user->nip === $reimbursement->diajukan_oleh 
                    ? Response::allow()
                    : Response::deny('Anda tidak diizinkan mengakses halaman ini');
        });

        Gate::define('unlock-data', function ($user, Reimbursement $reimbursement) {
            if(in_array($reimbursement->status, array('','Ditolak')))
                return true;
            else
                return false;
        });
    }
}
