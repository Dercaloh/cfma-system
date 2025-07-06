<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AuditoriaController extends Controller
{
    /**
     * Muestra la bitácora de auditoría del sistema con filtros opcionales.
     *
     * Normativa:
     * - Ley 1581: muestra solo datos mínimos necesarios del usuario (nombre), sin datos sensibles.
     * - ISO 27001: captura y visualiza trazabilidad completa (usuario, acción, IP, fecha).
     * - Ley 1712 y Resolución 1122: acceso a información institucional con filtros y visualización accesible.
     * - Software legal: uso de paquete Spatie Activitylog (licencia MIT).
     */
    public function index(Request $request)
    {
        $query = Activity::with('causer');

        // Filtro por usuario (causante)
        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        // Filtro por fechas
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        // Ordenar por fecha descendente y paginar
        $logs = $query->latest()->paginate(15);

        // Obtener todos los usuarios que tengan algún rol del sistema
        $roles = Role::pluck('name')->toArray();
        $usuarios = User::role($roles)->get();

        return view('admin.auditoria.index', compact('logs', 'usuarios'));
    }
}
