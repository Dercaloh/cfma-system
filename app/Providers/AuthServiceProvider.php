<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// ⛔ No importes ni construyas el contrato Gate manualmente

use App\Models\Loan;
use App\Policies\LoanPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * El mapa de políticas para la aplicación.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Loan::class => LoanPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies(); // <== ¡No lo elimines!

        // Aquí puedes registrar Gates manuales si lo necesitas
    }
}
