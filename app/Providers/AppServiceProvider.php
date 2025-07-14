<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Puedes registrar bindings, singletons u otros servicios aquí si es necesario
    }

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Registro de Componentes Blade Anónimos
        |--------------------------------------------------------------------------
        */
        Blade::anonymousComponentNamespace('components.profile', 'profile'); // x-profile::
        Blade::component('fields.help-icon', 'help-icon');                   // x-help-icon
        Blade::anonymousComponentNamespace('blade-ui-kit::heroicon-o', 'heroicon-o'); // x-heroicon-o::
        Blade::anonymousComponentNamespace('blade-ui-kit::heroicon-s', 'heroicon-s'); // x-heroicon-s::
        Blade::anonymousComponentNamespace('blade-ui-kit::heroicon-m', 'heroicon-m'); // x-heroicon-m::

        /*
        |--------------------------------------------------------------------------
        | Estilo de Paginación Personalizado
        |--------------------------------------------------------------------------
        */
        Paginator::defaultView('vendor.pagination.accessible-tailwind');

        /*
        |--------------------------------------------------------------------------
        | Auditoría Extendida (Spatie Activitylog)
        |--------------------------------------------------------------------------
        */
        Activity::saving(function (Activity $activity) {
            $props = collect($activity->properties ?? []);

            // Datos básicos de la solicitud
            $props->put('ip_address', request()->ip());
            $props->put('user_agent', request()->userAgent());

            // Agregar nombre de ruta (útil para trazabilidad modular)
            if (request()->route()?->getName()) {
                $props->put('module', request()->route()->getName());
            }

            // Acción por defecto si no se define explícitamente
            if (! $props->has('action')) {
                $props->put('action', $activity->event);
            }

            $activity->properties = $props;

            // Asociar usuario autenticado si no se ha definido
            if (Auth::check() && ! $activity->causer_id) {
                $activity->causer_type = get_class(Auth::user());
                $activity->causer_id = Auth::id();
            }

            // Establecer timestamp manualmente si no existe
            if (! $activity->created_at) {
                $activity->created_at = now();
            }
        });
    }
}
