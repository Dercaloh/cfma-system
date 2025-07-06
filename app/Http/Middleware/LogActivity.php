<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LogActivity
{
    /**
     * Maneja el registro de acciones del usuario mediante el helper activity()
     */
    public function handle(Request $request, Closure $next, string $action)
    {
        if (Auth::check()) {
            activity()
                ->causedBy(Auth::user())
                ->withProperties([
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'agent' => $request->userAgent(),
                ])
                ->log(Str::limit($action, 255));
        }

        return $next($request);
    }
}
