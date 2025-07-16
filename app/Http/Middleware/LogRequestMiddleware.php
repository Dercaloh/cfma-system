<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $route = $request->route()?->getName() ?? 'ruta_sin_nombre';
        $method = $request->getMethod();
        $ip = $request->ip();

        Log::info("📥 Solicitud entrante", [
            'usuario' => $user?->email ?? 'Anónimo',
            'rol' => $user?->getRoleNames() ?? [],
            'ruta' => $route,
            'método' => $method,
            'url' => $request->fullUrl(),
            'ip' => $ip,
        ]);

        return $next($request);
    }
}
