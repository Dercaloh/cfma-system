<?php

namespace App\Models\Assets;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Modelo: Detalle de Hardware del Activo
 * 🟡 Clasificación: Pública Clasificada
 * Contiene información técnica del activo (hardware y sistema).
 */
class AssetHardwareDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'asset_hardware_details';

    /**
     * Clasificación institucional de campos:
     * 🟢 Pública: os, bios_version
     * 🟡 Clasificada: mac_address, cpu, ram, storage
     * 🔴 Reservada: created_by, updated_by
     */
    protected $fillable = [
        'asset_id',        // 🔗 relación
        'mac_address',     // 🟡
        'os',              // 🟢
        'bios_version',    // 🟢
        'cpu',             // 🟡
        'ram',             // 🟡
        'storage',         // 🟡
        'created_by',      // 🔴
        'updated_by',      // 🔴
    ];

    protected $casts = [
        'mac_address' => 'string',
    ];

    /**
     * Auditoría automática con Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('asset_hardware')
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
