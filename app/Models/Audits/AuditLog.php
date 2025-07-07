<?php

namespace App\Models\Audits;

use Spatie\Activitylog\Models\Activity;

/**
 * Modelo: Registro de Auditoría General (AuditLog)
 * 🔴 Clasificación: Información Pública Reservada
 * Extiende el modelo de Spatie para representar eventos institucionales,
 * con detalles como IP, user agent, acción, módulo afectado y detalles adicionales.
 */
class AuditLog extends Activity
{
    // === Relaciones explícitas ===

    /**
     * Usuario responsable del evento (causante).
     */
    public function user()
    {
        return $this->causer(); // morphTo desde Spatie
    }

    /**
     * Modelo afectado por la acción (entidad objetivo).
     */
    public function target()
    {
        return $this->subject(); // morphTo desde Spatie
    }

    // === Accesores personalizados desde el campo JSON 'properties' ===

    /**
     * Dirección IP del evento.
     */
    public function getIpAddressAttribute(): ?string
    {
        return $this->properties['ip_address'] ?? null;
    }

    /**
     * User Agent del navegador o sistema que generó el evento.
     */
    public function getUserAgentAttribute(): ?string
    {
        return $this->properties['user_agent'] ?? null;
    }

    /**
     * Módulo funcional afectado (ej. Loans, Assets).
     */
    public function getModuleAttribute(): ?string
    {
        return $this->properties['module'] ?? null;
    }

    /**
     * Acción ejecutada (ej. update_loan, delete_asset).
     */
    public function getActionAttribute(): ?string
    {
        return $this->properties['action'] ?? $this->event;
    }

    /**
     * Detalles adicionales o descripción (JSON, texto).
     */
    public function getDetailsAttribute(): ?string
    {
        return $this->properties['details'] ?? null;
    }

    /**
     * Evento del sistema sin usuario autenticado.
     */
    public function getIsSystemEventAttribute(): bool
    {
        return (bool) ($this->properties['is_system_event'] ?? false);
    }
}
