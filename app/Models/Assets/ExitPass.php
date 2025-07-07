<?php

namespace App\Models\Assets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Modelo: Pase de salida de activo
 * 🟡 Clasificación: Información Pública Clasificada
 * Representa una autorización de salida temporal o permanente de un activo.
 */
class ExitPass extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    // === Campos permitidos para asignación masiva ===
    protected $fillable = [
        'gate_log_id',             // 🟡
        'cuentadante',             // 🔴
        'cedula',                  // 🔴
        'dependencia',             // 🟡
        'permiso',                 // 🟡
        'autorizado_salida',       // 🟡
        'autorizado_regreso',      // 🟡
        'signed_by',               // 🔴
        'archivo_pdf',             // 🔴
        'estado',                  // 🟡
        'created_by', 'updated_by', 'deleted_by', // 🔴
    ];

    protected $casts = [
        'autorizado_salida' => 'datetime',
        'autorizado_regreso' => 'datetime',
    ];

    // === Configuración de auditoría (spatie/laravel-activitylog) ===
    protected static $logName = 'exit_pass';
    protected static $submitEmptyLogs = false;

    /**
     * Configuración de auditoría personalizada
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'gate_log_id',
                'cuentadante',
                'cedula',
                'dependencia',
                'permiso',
                'autorizado_salida',
                'autorizado_regreso',
                'signed_by',
                'archivo_pdf',
                'estado',
                'created_by',
                'updated_by',
                'deleted_by',
            ])
            ->logOnlyDirty()
            ->useLogName('exit_pass')
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Pase de salida {$eventName}");
    }

    // === Relaciones ===

    public function gateLog()
    {
        return $this->belongsTo(GateLog::class);
    }

    public function signedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'signed_by');
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }

    public function documents()
    {
        return $this->morphMany(\App\Models\Documents\Document::class, 'documentable');
    }
}
