<?php

namespace App\Models\AccessControl;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\LogOptions;

class Role extends SpatieRole
{
    use HasFactory, SoftDeletes, LogsActivity, CausesActivity;

    /**
     * Atributos asignables masivamente
     */
    protected $fillable = [
        'name',           // 🟢 Público
        'description',    // 🟡 Clasificado
        'guard_name',     // 🟡 Clasificado
    ];

    /**
     * Configuración de auditoría
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'guard_name'])
            ->useLogName('roles')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "El rol '{$this->name}' fue {$eventName}");
    }

    /**
     * Representación en texto (accesibilidad, logging)
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
