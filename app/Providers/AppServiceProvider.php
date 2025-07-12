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
        //
    }

    public function boot(): void
    {
        // Estilo personalizado de paginación y componentes anónimos
        Blade::anonymousComponentNamespace('components.profile', 'profile');
        Paginator::defaultView('vendor.pagination.accessible-tailwind');
        Blade::component('fields.help-icon', 'help-icon');
        // Hook para agregar metadatos a cada evento de auditoría
        Activity::saving(function (Activity $activity) {
            $props = collect($activity->properties ?? []);

            $props->put('ip_address', request()->ip());
            $props->put('user_agent', request()->userAgent());

            // Puedes agregar más propiedades personalizadas aquí:
            if (request()->route()?->getName()) {
                $props->put('module', request()->route()->getName());
            }

            if (! $props->has('action')) {
                $props->put('action', $activity->event); // por defecto
            }

            $activity->properties = $props;

            // Asociar usuario autenticado
            if (Auth::check() && ! $activity->causer_id) {
                $activity->causer_type = get_class(Auth::user());
                $activity->causer_id = Auth::id();
            }

            // Timestamp si no está definido
            if (! $activity->created_at) {
                $activity->created_at = now();
            }
        });
    }
}
