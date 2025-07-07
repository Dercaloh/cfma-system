<?php

namespace App\Models\Policies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Users\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PolicyView extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'policy_views';

    /**
     * 🟡 Información Pública Clasificada
     */
    protected $fillable = [
        'ip_address',
        'user_agent',
        'user_id',
        'policy_version',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * 🔗 Relación: vista de política asociada a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 📋 Configuración de auditoría (Spatie)
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'user_id',
                'policy_version',
                'viewed_at',
                'ip_address',
            ])
            ->useLogName('vistas_politicas')
            ->setDescriptionForEvent(fn(string $eventName) =>
                "Versión {$this->policy_version} de política fue vista por el usuario ID {$this->user_id} ({$eventName})"
            );
    }
}
