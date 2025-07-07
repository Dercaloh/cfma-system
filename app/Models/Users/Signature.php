<?php

namespace App\Models\Users;

use App\Models\Loans\Loan;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Signature extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'signatures';

    /**
     * 🔴 Clasificación Institucional:
     * - loan_id, user_id, signature_blob, signature_hash: Reservada
     * - type, signed_at, observacion: Clasificada
     * - created_by, updated_by, deleted_by: Reservada
     */

    protected $fillable = [
        'loan_id',            // 🔴
        'user_id',            // 🔴
        'type',               // 🟡
        'signature_blob',     // 🔴
        'signature_hash',     // 🔴
        'signed_at',          // 🟡
        'observacion',        // 🟡
        'created_by',         // 🔴
        'updated_by',         // 🔴
        'deleted_by',         // 🔴
    ];

    protected $casts = [
        'signed_at' => 'datetime',
    ];

    /**
     * Configuración de auditoría automática
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('signature')
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relaciones
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
