<?php

namespace App\Models\Assets;

use App\Models\Users\User;
use App\Models\Assets\Asset;
use App\Models\Assets\ExitPass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Helpers\CryptoHelper;

class GateLog extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'gate_logs';

    protected $fillable = [
        'asset_id',
        'user_id',
        'action',
        'logged_at',
        'notes',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    // === Relaciones ===

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exitPass()
    {
        return $this->hasOne(ExitPass::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    // === 🔐 Cifrado en campo "notes" ===

    public function setNotesAttribute($value)
    {
        $this->attributes['notes'] = CryptoHelper::encrypt($value);
    }

    public function getNotesAttribute($value)
    {
        return CryptoHelper::decrypt($value);
    }

    // === 📋 Auditoría personalizada ===

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('gate_log')
            ->logOnly([
                'asset_id',
                'user_id',
                'action',
                'logged_at',
                'notes',
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) =>
                "Registro de {$eventName} en movimiento de activo (GateLog)."
            );
    }
}
