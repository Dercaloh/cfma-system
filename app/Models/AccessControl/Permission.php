<?php

namespace App\Models\AccessControl;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\Users\User;

class Permission extends SpatiePermission
{
    use HasFactory, SoftDeletes, LogsActivity, CausesActivity;

    protected $fillable = [
        'name',          // 🟢 Nombre público del permiso
        'guard_name',    // 🟡 Guardia de autenticación
        'description',   // 🟡 Descripción interna del permiso
        'created_by',    // 🟡 ID del usuario que creó el permiso
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Relación con el creador del permiso
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Configuración de auditoría con Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'guard_name', 'description'])
            ->useLogName('permissions')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "El permiso '{$this->name}' fue {$eventName}");
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
