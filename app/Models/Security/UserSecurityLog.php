<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSecurityLog extends Model
{
    use HasFactory;

    protected $table = 'user_security_logs';

    protected $fillable = [
        'user_id',
        'event_type',
        'description',
        'ip_address',
        'user_agent',
        'occurred_at',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
    ];

    /**
     * Relación inversa: el log pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Registro de evento de seguridad
     */
    public static function registrarEvento(array $datos): ?self
    {
        try {
            return self::create($datos);
        } catch (\Throwable $e) {
            report($e);
            return null;
        }
    }
}
