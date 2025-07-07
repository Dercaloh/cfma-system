<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\LogOptions;

class Role extends SpatieRole
{
    use HasFactory, SoftDeletes, LogsActivity, CausesActivity;

    protected $fillable = ['name', 'description'];

    /**
     * Configuración de auditoría Spatie (obligatorio)
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('roles')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "El rol '{$this->name}' fue {$eventName}");
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
