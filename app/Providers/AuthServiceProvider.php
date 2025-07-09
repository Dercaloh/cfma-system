<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// 🔐 Modelos y políticas
use App\Models\Users\User;
use App\Policies\UserPolicy;

use App\Models\Loans\Loan;
use App\Policies\LoanPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registro de políticas personalizadas.
     *
     * Aquí se asocia cada modelo con su política de acceso correspondiente.
     * Laravel utilizará esta configuración para los métodos:
     * - authorize()
     * - $user->can()
     * - @can / @cannot
     * - Gate::allows() / Gate::denies()
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Loan::class => LoanPolicy::class,
        // Puedes agregar aquí otras políticas conforme crezcas el sistema:
        // Activo::class => ActivoPolicy::class,
        // Permiso::class => PermisoPolicy::class,
    ];

    /**
     * Inicializa las políticas al arrancar la aplicación.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 🧩 Ejemplo de Gate manual si lo necesitas (no requerido por ahora)
        // Gate::define('ver-panel-admin', fn(User $user) => $user->hasRole('Administrador'));
    }
}
