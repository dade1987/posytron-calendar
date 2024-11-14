<?php

namespace App\Providers;

use App\Models\Shift;
use App\Policies\ShiftPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Shift::class => ShiftPolicy::class,
    ];
    /**
     * Registra qualsiasi servizio di autenticazione o autorizzazione.
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
