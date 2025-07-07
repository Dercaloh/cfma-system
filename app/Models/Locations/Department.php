<?php

namespace App\Models\Locations;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\NormalizesTextFields;

/**
 * Modelo Department
 *
 * 🔐 Clasificación Institucional:
 * - name: 🟢 Pública
 * - active: 🟢 Pública
 * - created_by / updated_by / deleted_by: 🟡 Clasificada
 * - timestamps: 🟡 Clasificada
 * - deleted_at: 🟡 Clasificada
 */
class Department extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, NormalizesTextFields;

    protected $table = 'departments';

    protected $fillable = [
        'name',         // 🟢 Pública
        'active',       // 🟢 Pública
        'created_by',   // 🟡 Clasificada
        'updated_by',   // 🟡 Clasificada
        'deleted_by',   // 🟡 Clasificada
    ];

    protected static $normalizeTextFields = ['name'];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * 🧾 Relaciones con usuarios para trazabilidad
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * 📝 Auditoría con Spatie Activity Log
     */
    protected static function booted(): void
    {
        static::creating(fn($model) => $model->logName = 'departments');
        static::updating(fn($model) => $model->logName = 'departments');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'active']) // 🟢 solo campos públicos
            ->useLogName('departments')
            ->setDescriptionForEvent(fn(string $eventName) => "El departamento fue {$eventName}");
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
