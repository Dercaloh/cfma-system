<?php

namespace App\Models\Policies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\Users\User;

class UserPolicy extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'user_policies';

    /**
     * 🟡 Información Pública Clasificada
     */
    protected $fillable = [
        'user_id',
        'policy_name',
        'policy_version',
        'accepted_at',

        /**
         * 🔴 Información Pública Reservada
         */
        'accepted_ip',
        'accepted_user_agent',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    protected $hidden = [
        'accepted_ip',
        'accepted_user_agent',
    ];

    /**
     * 🔗 Relación inversa: la política pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 📥 Registrar aceptación de política por usuario
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

    /**
     * 📝 Configuración de auditoría con Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'user_id',
                'policy_name',
                'policy_version',
                'accepted_at',
            ])
            ->useLogName('políticas_aceptadas')
            ->setDescriptionForEvent(fn(string $eventName) =>
                "Política '{$this->policy_name}' versión {$this->policy_version} fue {$eventName} por el usuario ID {$this->user_id}"
            );
    }
}
