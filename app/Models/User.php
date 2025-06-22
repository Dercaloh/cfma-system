<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Relations\BelongsTo,
    SoftDeletes
};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Atributos asignables masivamente
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
        'employee_id', 'department', 'email_verified_at'
    ];

    /**
     * Atributos ocultos
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Casts de atributos
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login' => 'datetime',
    ];

    /** Relación: Un usuario pertenece a un rol */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /** Relación: Un usuario puede tener muchos préstamos */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /** Relación: Un usuario puede generar logs de auditoría */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    /**
     * Verifica si el usuario tiene uno o varios roles
     */
    public function hasRole(string|array $roles): bool
    {
        $roleName = $this->role->name ?? null;
        return is_array($roles)
            ? in_array($roleName, $roles)
            : $roleName === $roles;
    }

    /** Registra el último inicio de sesión */
    public function registerLastLogin(): void
    {
        $this->last_login = now();
        $this->save();
    }
}
