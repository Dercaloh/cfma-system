<?php

namespace App\Models\Assets;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Modelo: Detalle de Software del Activo
 * 🟡 Clasificación: Pública Clasificada
 * Contiene información sobre los programas instalados en un activo institucional.
 */
class AssetSoftwareDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'asset_software_details';

    /**
     * Clasificación institucional de campos:
     * 🟡 Clasificada: name, version, vendor, license_status, install_date
     * 🔴 Reservada: created_by, updated_by
     */
    protected $fillable = [
        'asset_id',         // 🔗 relación con activo
        'name',             // 🟡 Nombre del software
        'version',          // 🟡 Versión
        'vendor',           // 🟡 Proveedor
        'license_status',   // 🟡 Estado de la licencia
        'install_date',     // 🟡 Fecha de instalación
        'created_by',       // 🔴 Auditoría
        'updated_by',       // 🔴 Auditoría
    ];

    protected $casts = [
        'install_date' => 'date',
    ];

    /**
     * Auditoría de cambios con Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('asset_software')
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // === Relaciones ===

    public function asset()
    {
        return $this->belongsTo(Asset::class)->withTrashed();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }
}
