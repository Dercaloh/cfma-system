<?php

namespace App\Models\Programs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\NormalizesTextFields;
use App\Models\Users\User;

class Position extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, NormalizesTextFields;

    // Tabla asociada
    protected $table = 'positions';

    // Campos asignables
    protected $fillable = [
        'title',    // Nombre del cargo o función
        'active',   // Estado de uso (tinyint)
    ];

    // Casts automáticos
    protected $casts = [
        'active' => 'boolean',
    ];

    // ────────── Relaciones ──────────

    /**
     * Usuarios que tienen esta posición
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'position_id');
    }

    // ────────── Scopes ──────────

    /**
     * Solo posiciones activas
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Solo posiciones inactivas
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * Buscar por título
     */
    public function scopeSearch($query, string $term)
    {
        return $query->where('title', 'like', '%' . trim($term) . '%');
    }

    // ────────── Accessors & Mutators ──────────

    /**
     * Mostrar título capitalizado
     */
    public function getTitleAttribute(string $value): string
    {
        return ucwords(mb_strtolower($value));
    }

    /**
     * Guardar título sin espacios extra
     */
    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = trim($value);
    }

    // ────────── Auditoría de actividad ──────────

    protected static function booted(): void
    {
        static::creating(fn(self $m) => $m->logName = 'positions');
        static::updating(fn(self $m) => $m->logName = 'positions');
        static::deleting(fn(self $m) => $m->logName = 'positions');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('positions')
            ->logOnly(['title', 'active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $event) =>
                "La posición “{$this->title}” fue {$event}"
            );
    }

    // ────────── Representación legible ──────────

    public function __toString(): string
    {
        return $this->title;
    }
}
