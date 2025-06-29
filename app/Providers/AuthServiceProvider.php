<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Loan;
use App\Policies\LoanPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registro de políticas personalizadas.
     *
     * Aquí se asocia cada modelo con su política de acceso correspondiente.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Loan::class => LoanPolicy::class,
    ];

    /**
     * Inicializa las políticas.
     *
     * Este método se ejecuta al arrancar la aplicación y asegura
     * que las políticas estén disponibles para los métodos authorize(),
     * can(), @can, @cannot, Gate::allows() y similares.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Puedes definir Gates manuales si necesitas permisos simples
        // Gate::define('ver-admin', fn ($user) => $user->role->name === 'admin');
    }
}
