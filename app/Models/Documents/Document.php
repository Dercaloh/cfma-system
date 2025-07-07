<?php

namespace App\Models\Documents;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Modelo: Document
 * 🟥 Clasificación: Pública Reservada
 * Maneja archivos institucionales cifrados, vinculados polimórficamente a otros modelos.
 */
class Document extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'documents';

    /**
     * Clasificación institucional de campos:
     * - 🟢 Pública: mime_type
     * - 🟡 Clasificada: name, size, hash_sha256
     * - 🔴 Reservada: storage_path, documentable_*, created_by, updated_by, deleted_by
     */
    protected $fillable = [
        'name',             // 🟡
        'mime_type',        // 🟢
        'size',             // 🟡
        'hash_sha256',      // 🟡
        'storage_path',     // 🔴
        'documentable_id',  // 🔴
        'documentable_type',// 🔴
        'created_by',       // 🔴
        'updated_by',       // 🔴
        'deleted_by',       // 🔴
    ];

    protected $casts = [
        'size' => 'integer',
    ];

    /**
     * Auditoría automática con Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('document')
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relación polimórfica
     */
    public function documentable()
    {
        return $this->morphTo();
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
