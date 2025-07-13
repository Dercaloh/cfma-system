<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\NormalizesTextFields;
use App\Models\Users\User;

class Department extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, NormalizesTextFields;

    // Tabla en la BD
    protected $table = 'departments';

    // Sólo estos campos están en tu esquema
    protected $fillable = [
        'name',    // 🟢 Pública
        'active',  // 🟢 Pública (tinyint(1))
    ];

    // Normaliza el campo 'name'
    protected static $normalizeTextFields = ['name'];

    // Casteo automático
    protected $casts = [
        'active' => 'boolean',
    ];

    // ────────── Relaciones ──────────

    /**
     * Usuarios asignados a este departamento
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    // ────────── Scopes ──────────

    /**
     * Sólo departamentos activos
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Sólo departamentos inactivos
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * Buscar por nombre
     */
    public function scopeSearch($query, string $term)
    {
        $term = trim($term);
        return $query->where('name', 'like', "%{$term}%");
    }

    // ────────── Accessors & Mutators ──────────

    /**
     * Nombre capitalizado para presentación
     */
    public function getNameAttribute(string $value): string
    {
        return ucwords(mb_strtolower($value));
    }

    // ────────── Auditoría de actividad ──────────

    /**
     * Nombre del log
     */
    protected static function booted(): void
    {
        static::creating(fn(self $model) => $model->logName = 'departments');
        static::updating(fn(self $model) => $model->logName = 'departments');
        static::deleting(fn(self $model) => $model->logName = 'departments');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('departments')
            ->logOnly(['name', 'active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $event) =>
                "El departamento “{$this->name}” fue {$event}"
            );
    }

    // ────────── Representación legible ──────────

    public function __toString(): string
    {
        return $this->name;
    }
}
