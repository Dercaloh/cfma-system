<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\NormalizesTextFields;
use App\Models\Users\User;
use App\Models\Locations\Branch;

class Location extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, NormalizesTextFields;

    // Tabla asociada
    protected $table = 'locations';

    // Campos asignables
    protected $fillable = [
        'branch_id',    // 🟢 Pública
        'name',         // 🟢 Pública
        'description',  // 🟢 Pública
        'active',       // 🟢 Pública (tinyint)
    ];

    // Normalizar texto
    protected static $normalizeTextFields = ['name', 'description'];

    // Casts automáticos
    protected $casts = [
        'active' => 'boolean',
    ];

    // ────────── Relaciones ──────────

    /**
     * Sede a la que pertenece esta ubicación
     */
    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Usuarios asignados a esta ubicación
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'location_id');
    }

    // ────────── Scopes ──────────

    /**
     * Sólo ubicaciones activas
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Sólo ubicaciones inactivas
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * Búsqueda por nombre o descripción
     */
    public function scopeSearch($query, string $term)
    {
        $term = trim($term);
        return $query->where('name',        'like', "%{$term}%")
                     ->orWhere('description','like', "%{$term}%");
    }

    // ────────── Accessors & Mutators ──────────

    /**
     * Nombre capitalizado para presentación
     */
    public function getNameAttribute(string $value): string
    {
        return ucwords(mb_strtolower($value));
    }

    /**
     * Descripción limpia (trim + mayúscula inicial)
     */
    public function setDescriptionAttribute(?string $value): void
    {
        $clean = $value ? trim($value) : null;
        $this->attributes['description'] = $clean
            ? ucfirst(mb_strtolower($clean))
            : null;
    }

    // ────────── Auditoría de Actividad ──────────

    protected static function booted(): void
    {
        static::creating(fn(self $model) => $model->logName = 'locations');
        static::updating(fn(self $model) => $model->logName = 'locations');
        static::deleting(fn(self $model) => $model->logName = 'locations');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('locations')
            ->logOnly(['branch_id', 'name', 'description', 'active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $event) =>
                "La ubicación interna “{$this->name}” fue {$event}"
            );
    }

    // ────────── Representación ──────────

    public function __toString(): string
    {
        return $this->name;
    }
}
