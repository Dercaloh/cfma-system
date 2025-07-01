<?php

namespace App\Models;


use App\Models\Security\UserSecurity;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'role_id',
        'employee_id',
        'department_id',
        'location_id',
        // otros campos necesarios según migración...
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'mfa_secret',       // legacy en users, ocultar
        'phone_for_otp',    // legacy en users, ocultar
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_password_change_at' => 'datetime',
        'account_valid_from' => 'date',
        'account_valid_until' => 'date',
        'consent_timestamp' => 'datetime',
    ];

    // Accesor para full_name (si prefieres acceder como propiedad)
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Relación con Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relación con préstamos
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    // Relación con registros de auditoría
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    // Relación con seguridad avanzada (MFA)
    public function security()
    {
        return $this->hasOne(UserSecurity::class);
    }

    /**
     * Verifica si el usuario tiene un rol específico
     *
     * @param string $roleName Nombre del rol a verificar
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Indica si el MFA está activado para el usuario,
     * prioriza el valor en tabla user_security, sino usa legacy.
     *
     * @return bool
     */
    public function isMfaEnabled(): bool
    {
        if ($this->security) {
            return (bool) $this->security->mfa_enabled;
        }

        // fallback legacy
        return (bool) $this->mfa_enabled;
    }
}
