<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPolicy extends Model
{
    use HasFactory;

    protected $table = 'user_policies';

    protected $fillable = [
        'user_id',
        'policy_name',
        'policy_version',
        'accepted_at',
        'accepted_ip',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    /**
     * Relación inversa: la política pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Registro de aceptación de política
     */
    public static function registrarAceptacion(array $datos): ?self
    {
        try {
            return self::create($datos);
        } catch (\Throwable $e) {
            report($e);
            return null;
        }
    }
}
