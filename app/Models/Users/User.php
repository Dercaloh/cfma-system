<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\LogOptions;

use App\Helpers\CryptoHelper;

// Relaciones
use App\Models\Locations\Department;
use App\Models\Locations\Branch;
use App\Models\Locations\Location;
use App\Models\Programs\Position;
use App\Models\Loans\Loan;
use App\Models\Policies\UserPolicy;
use App\Models\AccessControl\UserSecurity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles, LogsActivity, CausesActivity, \App\Traits\NormalizesTextFields;

    protected $fillable = [
        // 🟢 Datos generales
        'first_name',
        'last_name',
        'username',
        'email',
        'identification_number',
        'document_type',
        'phone_number',
        'personal_email',
        'institutional_email',
        'employee_id',

        // Relaciones
        'department_id',
        'branch_id',
        'location_id',
        'position_id',

        // Seguridad y control de acceso
        'password',
        'remember_token',
        'last_password_change_at',
        'password_policy_version',
        'last_login_at',
        'last_login_ip',
        'email_verified_at',

        // Estado de cuenta
        'status',
        'account_valid_from',
        'account_valid_until',

        // Consentimientos
        'consent_data_processing',
        'consent_marketing',
        'consent_data_sharing',
        'consent_timestamp',
        'privacy_policy_version',

        // Opcional en tu sistema
        'mfa_enabled',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'mfa_secret',
        'phone_for_otp',
        'device_info_encrypted',
    ];

    protected $casts = [
        'email_verified_at'        => 'datetime',
        'last_login_at'            => 'datetime',
        'last_password_change_at'  => 'datetime',
        'account_valid_from'       => 'date',
        'account_valid_until'      => 'date',
        'consent_data_processing'  => 'boolean',
        'consent_marketing'        => 'boolean',
        'consent_data_sharing'     => 'boolean',
        'consent_timestamp'        => 'datetime',
        'mfa_enabled'              => 'boolean',
        'deleted_at'               => 'datetime',
    ];

    protected static $normalizeTextFields = ['first_name', 'last_name'];

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getMfaSecretAttribute($value): ?string
    {
        return $value ? CryptoHelper::decrypt($value) : null;
    }

    public function getPhoneForOtpAttribute($value): ?string
    {
        return $value ? CryptoHelper::decrypt($value) : null;
    }

    public function getDeviceInfoEncryptedAttribute($value): ?array
    {
        return $value ? json_decode(CryptoHelper::decrypt($value), true) : null;
    }

    // Relaciones
    public function department()  { return $this->belongsTo(Department::class); }
    public function branch()      { return $this->belongsTo(Branch::class); }
    public function location()    { return $this->belongsTo(Location::class); }
    public function position()    { return $this->belongsTo(Position::class); }

    public function loans()       { return $this->hasMany(Loan::class); }
    public function policies()    { return $this->hasMany(UserPolicy::class); }
    public function security()    { return $this->hasOne(UserSecurity::class); }

    public function latestPolicy(string $name): ?UserPolicy
    {
        return $this->policies()
                    ->where('policy_name', $name)
                    ->latest('accepted_at')
                    ->first();
    }

    public function isMfaEnabled(): bool
    {
        return $this->security
            ? (bool) $this->security->mfa_enabled
            : (bool) $this->mfa_enabled;
    }

    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['first_name', 'last_name', 'email', 'status'])
            ->useLogName('usuarios')
            ->setDescriptionForEvent(fn(string $eventName) =>
                "El usuario {$this->full_name} fue {$eventName}"
            );
    }

    public function __toString(): string
    {
        return $this->full_name;
    }

    public function isActive(): bool
    {
        return $this->status === 'activo';
    }
}
