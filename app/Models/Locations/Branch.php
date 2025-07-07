<?php

namespace App\Models\Locations;

use App\Models\Users\User;
use App\Models\Locations\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\NormalizesTextFields;

/**
 * Modelo Branch
 *
 * 🔐 Clasificación Institucional:
 * - name: 🟢 Pública
 * - active: 🟢 Pública
 * - timestamps: 🟡 Clasificada
 * - deleted_at: 🟡 Clasificada
 */
class Branch extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, NormalizesTextFields;

    protected $table = 'branches';

    protected $fillable = [
        'name',      // 🟢 Pública
        'active',    // 🟢 Pública
    ];

    protected static $normalizeTextFields = ['name'];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * 🧾 Relación: Ubicaciones físicas internas dentro de esta sede
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * 🧾 Relación: Usuarios asignados a esta sede
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * 📝 Auditoría con Spatie Activity Log
     */
    protected static function booted(): void
    {
        static::creating(fn($model) => $model->logName = 'branches');
        static::updating(fn($model) => $model->logName = 'branches');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'active']) // Solo campos públicos
            ->useLogName('branches')
            ->setDescriptionForEvent(fn(string $eventName) => "La sede fue {$eventName}");
    }

    /**
     * 🧾 Accesor: Nombre capitalizado
     */
    public function getNameAttribute($value): string
    {
        return ucwords(mb_strtolower($value));
    }

    /**
     * 🧾 Representación legible
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
