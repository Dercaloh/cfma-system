<?php

namespace App\Models\Assets;

use App\Models\Assets\{AssetType, AssetHardwareDetail, AssetSoftwareDetail, ExitPass, GateLog};
use App\Models\Documents\Document;
use App\Models\Locations\Location;
use App\Models\Loans\Loan;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Modelo: Asset (Activo Tecnológico)
 * 🟡 Clasificación: Pública Clasificada
 * Gestiona activos institucionales con trazabilidad, ubicación y asignación.
 */
class Asset extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'assets';

    /**
     * Clasificación institucional de campos:
     * 🟢 Pública: name, brand, model, type_id, location_id, ownership
     * 🟡 Clasificada: serial_number, placa, year_purchased, status, condition, loanable, movable, assigned_to
     * 🔴 Reservada: created_by, updated_by, deleted_by
     */
    protected $fillable = [
        'name',               // 🟢
        'serial_number',      // 🟡
        'placa',              // 🟡
        'type_id',            // 🟢
        'ownership',          // 🟢
        'brand',              // 🟢
        'model',              // 🟢
        'year_purchased',     // 🟡
        'status',             // 🟡
        'condition',          // 🟡
        'location_id',        // 🟢
        'loanable',           // 🟡
        'movable',            // 🟡
        'assigned_to',        // 🟡
        'description',        // 🟡
        'created_by',         // 🔴
        'updated_by',         // 🔴
        'deleted_by',         // 🔴
    ];

    protected $casts = [
        'loanable' => 'boolean',
        'movable' => 'boolean',
        'year_purchased' => 'integer',
    ];

    /**
     * Auditoría automática con Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('asset')
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // === Relaciones ===

    public function type()
    {
        return $this->belongsTo(AssetType::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function cuentadante()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function hardwareDetails()
    {
        return $this->hasOne(AssetHardwareDetail::class);
    }

    public function softwareDetails()
    {
        return $this->hasMany(AssetSoftwareDetail::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function gateLogs()
    {
        return $this->hasMany(GateLog::class);
    }

    public function exitPasses()
    {
        return $this->hasManyThrough(ExitPass::class, GateLog::class);
    }

    // Auditoría manual (usuarios responsables)
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
