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

// Importaciones según estructura limpia
use App\Models\Locations\Department;
use App\Models\Locations\Branch;
use App\Models\Locations\Location;
use App\Models\Loans\Loan;
use App\Models\Policies\UserPolicy;
use App\Models\AccessControl\UserSecurity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles, LogsActivity, CausesActivity, \App\Traits\NormalizesTextFields;

    /**
     * 🟢 Información Pública (visible institucionalmente)
     * 🟡 Información Pública Clasificada (uso interno)
     * 🔴 Información Pública Reservada (solo en hidden)
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',            // ← AÑADIDO: para poder persistir la contraseña
        'employee_id',
        'job_title',
        'department_id',
        'branch_id',
        'location_id',
        'document_type',
        'identification_number',

        // Campos de uso interno
        'status',
        'account_valid_from',
        'account_valid_until',
        'last_password_change_at',
        'last_login_ip',
        'last_login_at',
        'password_policy_version',

        'consent_data_processing',
        'consent_marketing',
        'consent_data_sharing',
        'consent_timestamp',
        'privacy_policy_version',

        'mfa_enabled',
    ];

    /**
     * 🔴 Campos ocultos en serialización
     */
    protected $hidden = [
        'password',
        'remember_token',
        'mfa_secret',
        'phone_for_otp',
        'device_info_encrypted',
    ];

    /**
     * 🔢 Casts de atributos
     */
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
    ];

    /**
     * 🔤 Campos que normalizamos al guardar
     */
    protected static $normalizeTextFields = ['first_name', 'last_name'];

    /**
     * ✅ Nombre completo virtual
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * 🔐 Desencriptado de campos sensibles (MFA, teléfono, device info)
     */
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

    /**
     * 🔗 Relaciones institucionales
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function policies()
    {
        return $this->hasMany(UserPolicy::class);
    }

    public function security()
    {
        return $this->hasOne(UserSecurity::class);
    }

    /**
     * 🕒 Obtener última política aceptada por nombre
     */
    public function latestPolicy(string $name): ?UserPolicy
    {
        return $this->policies()
                    ->where('policy_name', $name)
                    ->latest('accepted_at')
                    ->first();
    }

    /**
     * ✅ Verifica si MFA está habilitado
     */
    public function isMfaEnabled(): bool
    {
        return $this->security
            ? (bool) $this->security->mfa_enabled
            : (bool) $this->mfa_enabled;
    }

    /**
     * 🔘 Retorna el primer rol asignado (para interfaz)
     */
    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    /**
     * 📝 Configuración de auditoría con Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['first_name', 'last_name', 'email', 'status'])
            ->useLogName('usuarios')
            ->setDescriptionForEvent(fn(string $eventName) =>
                "El usuario {$this->full_name} fue {$eventName}"
            );
    }

    /**
     * 📛 Representación por defecto al convertir a string
     */
    public function __toString(): string
    {
        return $this->full_name;
    }
}
