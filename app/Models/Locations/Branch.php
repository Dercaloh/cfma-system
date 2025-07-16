<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\NormalizesTextFields;
use App\Models\Users\User;

class Branch extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, NormalizesTextFields;

    // Nombre de la tabla en BD
    protected $table = 'branches';

    // Campos asignables en masa
    protected $fillable = [
        'name',       // 🟢 Pública
        'code',       // 🟢 Pública
        'address',    // 🟢 Pública
        'phone',      // 🟢 Pública
        'active',     // 🟢 Pública
    ];

    // Normalizar automáticamente estos campos de texto
    protected static $normalizeTextFields = ['name', 'address'];

    // Casts automáticos
    protected $casts = [
        'active' => 'boolean',
    ];

    // ────────── Relaciones ──────────

    /**
     * Ubicaciones físicas internas de esta sede
     */
    public function locations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Usuarios asignados a esta sede
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    // ────────── Scopes ──────────

    /**
     * Solo sedes activas
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Solo sedes inactivas
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * Buscar sedes por nombre o código
     */
    public function scopeSearch($query, string $term)
    {
        $term = trim($term);
        return $query->where('name',   'like', "%{$term}%")
                     ->orWhere('code', 'like', "%{$term}%");
    }

    // ────────── Accessors & Mutators ──────────

    /**
     * Siempre almacenar el código en mayúsculas y sin espacios
     */
    public function setCodeAttribute(?string $value): void
    {
        $this->attributes['code'] = $value ? strtoupper(trim($value)) : null;
    }

    /**
     * Nombre capitalizado para presentación
     */
    public function getNameAttribute(string $value): string
    {
        return ucwords(mb_strtolower($value));
    }

    // ────────── Auditoría de actividad ──────────

    protected static function booted(): void
    {
        // Nombre de log personalizado
        static::creating(fn(self $model) => $model->logName = 'branches');
        static::updating(fn(self $model) => $model->logName = 'branches');
        static::deleting(fn(self $model) => $model->logName = 'branches');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'code', 'address', 'phone', 'active'])
            ->useLogName('branches')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) =>
                "La sede “{$this->name}” fue {$eventName}"
            );
    }

    // ────────── Representación legible ──────────

    public function __toString(): string
    {
        return $this->name;
    }
}
