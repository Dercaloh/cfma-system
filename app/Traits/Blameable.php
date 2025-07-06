<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Blameable
{
    public static function bootBlameable(): void
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = $model->created_by ?? Auth::id();
                $model->updated_by = $model->updated_by ?? Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (Auth::check() && $model->usesSoftDeletes()) {
                $model->deleted_by = Auth::id();
                $model->saveQuietly(); // evita loops
            }
        });

        // Opcional: auditar manualmente sin duplicar con LogsActivity
        static::created(function ($model) {
            if (Auth::check() && ! method_exists($model, 'getActivitylogOptions')) {
                activity()
                    ->performedOn($model)
                    ->causedBy(Auth::user())
                    ->withProperties(['evento' => 'creado manual'])
                    ->log(class_basename($model) . ' creado');
            }
        });
    }

    protected function usesSoftDeletes(): bool
    {
        return method_exists($this, 'getDeletedAtColumn');
    }
}
