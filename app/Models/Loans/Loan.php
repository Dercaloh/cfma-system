<?php

namespace App\Models\Loans;

use App\Models\Users\User;
use App\Models\Assets\Asset;
use App\Models\Loans\LoanDetail;
use App\Models\Loans\LoanStatus;
use App\Models\Documents\Document;
use App\Models\Users\Signature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Modelo Loan
 *
 * 📚 Clasificación Institucional:
 * - 🔴 Reservada: aprobadores, fechas de entrega, devolución
 * - 🟡 Clasificada: estado, observaciones, timestamps
 * - 🟢 Pública: nada expuesto directamente
 */
class Loan extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id',
        'asset_id',
        'status_id',
        'approved_by',
        'delivered_by',
        'received_by',
        'requested_at',
        'approved_at',
        'delivered_at',
        'returned_at',
        'notes',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at'  => 'datetime',
        'delivered_at' => 'datetime',
        'returned_at'  => 'datetime',
    ];

    // Relación principal: Usuario que solicita
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed()->withDefault([
            'name' => 'Desconocido',
            'email' => '—'
        ]);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class)->withTrashed()->withDefault([
            'name' => 'Activo eliminado',
        ]);
    }

    public function status()
    {
        return $this->belongsTo(LoanStatus::class)->withDefault([
            'name' => 'Desconocido'
        ]);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by')->withTrashed();
    }

    public function deliveredBy()
    {
        return $this->belongsTo(User::class, 'delivered_by')->withTrashed();
    }

    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by')->withTrashed();
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

    public function details()
    {
        return $this->hasOne(LoanDetail::class);
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Auditoría con spatie/laravel-activitylog
     */
    protected static function booted(): void
    {
        static::creating(fn($model) => $model->logName = 'loans');
        static::updating(fn($model) => $model->logName = 'loans');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'user_id',
                'asset_id',
                'status_id',
                'approved_by',
                'delivered_by',
                'received_by',
                'approved_at',
                'delivered_at',
                'returned_at',
            ])
            ->useLogName('loans')
            ->setDescriptionForEvent(fn(string $eventName) => "Registro de préstamo fue {$eventName}");
    }

    public function __toString(): string
    {
        return "Préstamo ID #{$this->id} - Usuario: {$this->user->name}";
    }
}
