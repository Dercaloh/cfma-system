<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Models\Security\UserSecurity;
use App\Models\UserPolicy;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles, LogsActivity, CausesActivity, \App\Traits\NormalizesTextFields;

    /**
     * Campos que se pueden asignar masivamente
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'employee_id',
        'department_id',
        'location_id',
        'status',
        'job_title',
        'account_valid_from',
        'account_valid_until',
        'consent_data_processing',
        'consent_marketing',
        'consent_data_sharing',
        'consent_timestamp',
        'privacy_policy_version',
        'mfa_enabled',
    ];

    /**
     * Campos sensibles ocultos al serializar
     */
    protected $hidden = [
        'password',
        'remember_token',
        'mfa_secret', // legacy
        'phone_for_otp', // legacy
        'device_info_encrypted',
    ];

    /**
     * Conversión de tipos
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_password_change_at' => 'datetime',
        'account_valid_from' => 'date',
        'account_valid_until' => 'date',
        'consent_data_processing' => 'boolean',
        'consent_marketing' => 'boolean',
        'consent_data_sharing' => 'boolean',
        'consent_timestamp' => 'datetime',
        'mfa_enabled' => 'boolean',
    ];

    /**
     * Campos a normalizar con el trait personalizado
     */
    protected static $normalizeTextFields = ['first_name', 'last_name'];

    /**
     * Accesor: Nombre completo del usuario
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Relación: Préstamos hechos por el usuario
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Relación: Logs de seguridad
     */
    public function security()
    {
        return $this->hasOne(UserSecurity::class);
    }

    /**
     * Relación: Políticas aceptadas por el usuario
     */
    public function policies()
    {
        return $this->hasMany(UserPolicy::class);
    }

    /**
     * Relación: Última política aceptada
     */
    public function latestPolicy(string $name): ?UserPolicy
    {
        return $this->policies()
            ->where('policy_name', $name)
            ->latest('accepted_at')
            ->first();
    }

    /**
     * Verifica si el MFA está activo
     */
    public function isMfaEnabled(): bool
    {
        return $this->security ? (bool) $this->security->mfa_enabled : (bool) $this->mfa_enabled;
    }

    /**
     * Acceso al primer rol asignado
     */
    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    /**
     * Relaciones adicionales
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Spatie Activitylog: Personaliza el nombre mostrado en la bitácora
     */
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['first_name', 'last_name', 'email'])
            ->useLogName('usuarios')
            ->setDescriptionForEvent(fn(string $eventName) => "El usuario {$this->full_name} fue {$eventName}");
    }

    /**
     * Para mostrar nombre legible en la auditoría (Spatie)
     */
    public function __toString(): string
    {
        return $this->full_name;
    }
}
