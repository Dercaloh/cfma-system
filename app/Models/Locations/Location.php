<?php

namespace App\Models\Locations;

use App\Models\Users\User;
use App\Models\Locations\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\NormalizesTextFields;

/**
 * Modelo Location
 *
 * 🔐 Clasificación Institucional:
 * - name: 🟢 Pública
 * - branch_id: 🟢 Pública
 * - description: 🟢 Pública
 * - active: 🟢 Pública
 * - timestamps: 🟡 Clasificada
 * - deleted_at: 🟡 Clasificada
 */
class Location extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, NormalizesTextFields;

    protected $table = 'locations';

    protected $fillable = [
        'branch_id',       // 🟢 Pública
        'name',            // 🟢 Pública
        'description',     // 🟢 Pública
        'active',          // 🟢 Pública
    ];

    protected static $normalizeTextFields = ['name'];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * 📌 Relaciones
     */

    // 🔁 Relación: Sede (branch) a la que pertenece esta ubicación
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // 🔁 Relación: Usuarios que están asignados a esta ubicación
    public function users()
    {
        return $this->hasMany(User::class, 'location_id');
    }

    /**
     * 📝 Auditoría con Spatie Activity Log
     */
    protected static function booted(): void
    {
        static::creating(fn($model) => $model->logName = 'locations');
        static::updating(fn($model) => $model->logName = 'locations');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['branch_id', 'name', 'active']) // Campos públicos
            ->useLogName('locations')
            ->setDescriptionForEvent(fn(string $eventName) => "Ubicación interna fue {$eventName}");
    }

    /**
     * 🧾 Representación legible
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
