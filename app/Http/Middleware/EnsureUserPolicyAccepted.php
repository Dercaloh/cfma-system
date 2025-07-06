<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserPolicyAccepted
{
    /**
     * Verifica que el usuario autenticado haya aceptado la última versión de la política.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Si no hay usuario autenticado o está accediendo a rutas permitidas
        if (!$user || Route::is([
            'login',
            'logout',
            'register',
            'password.*',
            'politicas.*',
        ])) {
            return $next($request);
        }

        // Verifica si aceptó la política de tratamiento versión '1.0.0'
        $last = $user->latestPolicy('data_protection');
        if (!$last || $last->policy_version !== '1.0.0') {
            return redirect()->route('politicas.show')
                ->with('warning', 'Debes aceptar la política de tratamiento de datos personales para continuar.');
        }

        return $next($request);
    }
}
