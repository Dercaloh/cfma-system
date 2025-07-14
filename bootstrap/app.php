<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// ✅ Middlewares de Spatie correctamente referenciados
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

// ✅ Middlewares propios y estándar
use App\Http\Middleware\LogRequestMiddleware;
use App\Http\Middleware\EnsureUserPolicyAccepted;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Routing\Middleware\ThrottleRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 🔗 Alias de middlewares
        $middleware->alias([
            // Spatie Laravel Permission
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,

            // Laravel y propios
            'verified' => EnsureEmailIsVerified::class,
            'signed' => ValidateSignature::class,
            'throttle' => ThrottleRequests::class,
            'can' => Authorize::class,

            // Trazabilidad de acciones
            'log_request' => LogRequestMiddleware::class,
        ]);

        // 🛡️ Middleware global obligatorio
        $middleware->append([
            EnsureUserPolicyAccepted::class,
        ]);

        // 🌐 Grupo WEB
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // 📡 Grupo API
        $middleware->group('api', [
            ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // 🛠️ Grupo ADMIN institucional
        $middleware->group('admin', [
            'web',
            'auth',
            'verified',
            'role:Administrador',
            'permission:gestionar tipos de activos',
            'log_request',
            EnsureUserPolicyAccepted::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
