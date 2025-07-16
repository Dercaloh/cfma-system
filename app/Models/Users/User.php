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

use Illuminate\Support\Facades\Hash;
use App\Helpers\CryptoHelper;
use App\Traits\NormalizesTextFields;

// Modelos relacionados
use App\Models\Locations\Branch;
use App\Models\Locations\Department;
use App\Models\Locations\Location;
use App\Models\Programs\Position;
use App\Models\Loans\Loan;
use App\Models\Policies\UserPolicy;
use App\Models\AccessControl\UserSecurity;

class User extends Authenticatable
{
    use HasFactory,
        Notifiable,
        SoftDeletes,
        HasRoles,
        LogsActivity,
        CausesActivity,
        NormalizesTextFields;

    // ────────── Configuración ──────────

    protected $table = 'users';

    protected $fillable = [
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
        'department_id',
        'branch_id',
        'location_id',
        'position_id',
        'password',
        'status',
        'account_valid_from',
        'account_valid_until',
        'consent_data_processing',
        'consent_marketing',
        'consent_data_sharing',
        'consent_timestamp',
        'privacy_policy_version',
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
        'account_valid_from'       => 'date',
        'account_valid_until'      => 'date',
        'consent_timestamp'        => 'datetime',
        'mfa_enabled'              => 'boolean',
        'deleted_at'               => 'datetime',
    ];

    // ────────── Accessors & Mutators ──────────

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function setPasswordAttribute(string $value): void
    {
        // Hasheo seguro de la contraseña
        $this->attributes['password'] = Hash::make($value);
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

    // ────────── Relaciones ──────────

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function position(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function loans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function policies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserPolicy::class);
    }

    public function security(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserSecurity::class);
    }

    // ────────── Scopes ──────────

    /**
     * Usuarios con estado 'activo'
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'activo');
    }

    /**
     * Filtrar por rol (Spatie)
     */
    public function scopeByRole($query, string $role)
    {
        return $query->whereHas('roles', fn($q) => $q->where('name', $role));
    }

    // ────────── Métodos Útiles ──────────

    /**
     * Última política aceptada por nombre
     */
    public function latestPolicy(string $name): ?UserPolicy
    {
        return $this->policies()
            ->where('policy_name', $name)
            ->latest('accepted_at')
            ->first();
    }

    /**
     * ¿MFA activado?
     */
    public function isMfaEnabled(): bool
    {
        return $this->security
            ? (bool) $this->security->mfa_enabled
            : (bool) $this->mfa_enabled;
    }

    /**
     * Alias al primer rol asignado
     */
    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    /**
     * ¿Usuario activo?
     */
    public function isActive(): bool
    {
        return $this->status === 'activo';
    }

    public function __toString(): string
    {
        return $this->full_name;
    }

    // ────────── Configuración de Logs de Actividad ──────────

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('usuarios')
            ->logOnly(['first_name', 'last_name', 'email', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(
                fn(string $eventName) =>
                "El usuario {$this->full_name} fue {$eventName}"
            );
    }
}
