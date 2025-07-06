<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Este callback se ejecuta antes de guardar cualquier log
        Activity::saving(function (Activity $activity) {
            // Asignar el usuario autenticado (causer), si existe
            if (Auth::check()) {
                $activity->causer_id = Auth::id();
                $activity->causer_type = get_class(Auth::user());
            }

            // Guardar la IP en las propiedades del log
            $activity->properties = $activity->properties->merge([
                'ip' => Request::ip(),
            ]);
        });
    }
}
