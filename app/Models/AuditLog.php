<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity;

class AuditLog extends Activity
{
    /**
     * Relación con el usuario que causó el evento (causer).
     */
    public function user()
    {
        return $this->causer(); // ya definido por Spatie como morphTo
    }

    /**
     * Alias para el modelo afectado (subject).
     */
    public function target()
    {
        return $this->subject(); // también morphTo
    }

    /**
     * Accesor para dirección IP (desde properties->ip_address).
     */
    public function getIpAddressAttribute()
    {
        return $this->properties['ip_address'] ?? null;
    }

    /**
     * Accesor para User Agent (desde properties->user_agent).
     */
    public function getUserAgentAttribute()
    {
        return $this->properties['user_agent'] ?? null;
    }

    /**
     * Accesor para módulo (si lo incluyes manualmente).
     */
    public function getModuleAttribute()
    {
        return $this->properties['module'] ?? null;
    }

    /**
     * Accesor para acción personalizada (puedes usarla como complemento de "event").
     */
    public function getActionAttribute()
    {
        return $this->properties['action'] ?? $this->event;
    }

    /**
     * Accesor para detalles adicionales.
     */
    public function getDetailsAttribute()
    {
        return $this->properties['details'] ?? null;
    }
}
