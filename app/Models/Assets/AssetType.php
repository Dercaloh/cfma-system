<?php

namespace App\Models\Assets;

use App\Models\Users\User;
use App\Models\Assets\Asset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Modelo: Tipo de Activo TI
 * 🟢 Clasificación: Información Pública
 * Define categorías de activos institucionales (ej. portátil, monitor, proyector).
 */
class AssetType extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'asset_types';

    /**
     * Campos públicos del tipo de activo.
     */
    protected $fillable = [
        'name',         // 🟢 Nombre único del tipo de activo
        'description',  // 🟢 Descripción institucional
        'active',       // 🟢 Estado lógico
        'created_by',   // 🔴 Auditoría
        'updated_by',   // 🔴 Auditoría
        'deleted_by',   // 🔴 Auditoría
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Auditoría: spatie/laravel-activitylog
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('asset_type')
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // === Relaciones ===

    public function assets()
    {
        return $this->hasMany(Asset::class, 'type_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by')->withTrashed();
    }
}
