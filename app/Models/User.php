<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'employee_id',
    ];

    // Campos que deben ocultarse en respuestas JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts automáticos para columnas de la base de datos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación: Un usuario pertenece a un rol
     *
     * Esta relación permite acceder a los datos del rol usando:
     * $user->role->name
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relación: Un usuario puede tener muchos préstamos
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Relación: Un usuario puede tener muchos registros de auditoría
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}

