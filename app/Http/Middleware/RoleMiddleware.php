<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Verifica si el usuario autenticado tiene alguno de los roles permitidos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Illuminate\Http\Response
     */
   public function handle($request, Closure $next, ...$roles): Response
    {
     $user = Auth::user();

        if (!$user || !$user->role || !in_array($user->role->name, $roles)) {
            logger()->warning('Acceso denegado', [
                'user_id' => optional($user)->id,
                'rol' => optional($user->role)->name,
                'ruta' => $request->path()
            ]);

            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }

}
