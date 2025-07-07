<?php

namespace App\Models\AccessControl;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Helpers\CryptoHelper;

/**
 * Modelo UserSecurity
 *
 * 🔐 Clasificación Institucional:
 * - mfa_secret: 🔴 Reservada (cifrada)
 * - mfa_enabled, mfa_enabled_at: 🟡 Clasificada
 * - mfa_last_ip, mfa_last_verified_at: 🟡 Clasificada
 * - created_by, updated_by: 🟡 Clasificada
 * - timestamps: 🟡 Clasificada
 */
class UserSecurity extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'user_security';

    protected $fillable = [
        'user_id',                  // Relación directa
        'mfa_secret',               // 🔴 Reservada (cifrada)
        'mfa_enabled',              // 🟡 Clasificada
        'mfa_enabled_at',           // 🟡 Clasificada
        'mfa_last_ip',              // 🟡 Clasificada
        'mfa_last_verified_at',     // 🟡 Clasificada
        'created_by',               // 🟡 Clasificada
        'updated_by',               // 🟡 Clasificada
    ];

    protected $casts = [
        'mfa_enabled' => 'boolean',
        'mfa_enabled_at' => 'datetime',
        'mfa_last_verified_at' => 'datetime',
    ];

    /**
     * 🔁 Relación con el usuario propietario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 🔐 Accesor: Descifra el secreto TOTP solo cuando sea necesario
     */
    public function getMfaSecretAttribute($value)
    {
        return $value ? CryptoHelper::decrypt($value) : null;
    }

    /**
     * 🔐 Mutador: Cifra el secreto TOTP antes de almacenarlo
     */
    public function setMfaSecretAttribute($value)
    {
        $this->attributes['mfa_secret'] = $value ? CryptoHelper::encrypt($value) : null;
    }

    /**
     * 📝 Auditoría con Spatie Activity Log
     */
    protected static function booted(): void
    {
        static::creating(fn($model) => $model->logName = 'user_security');
        static::updating(fn($model) => $model->logName = 'user_security');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'mfa_enabled', 'mfa_enabled_at'])
            ->useLogName('user_security')
            ->setDescriptionForEvent(fn(string $eventName) => "Seguridad de usuario fue {$eventName}");
    }
}
