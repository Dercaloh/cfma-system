<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSecurityLog;
use Illuminate\Support\Facades\Auth;

class UserSecurityLogController extends Controller
{
    /**
     * Almacena un evento de seguridad personalizado
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_type' => 'required|in:login,logout,password_change,mfa_enabled,mfa_disabled,login_failed',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            UserSecurityLog::create([
                'user_id'     => Auth::id(),
                'event_type'  => $request->input('event_type'),
                'description' => $request->input('description'),
                'ip_address'  => $request->ip(),
                'user_agent'  => $request->header('User-Agent'),
                'occurred_at' => now(),
            ]);

            return response()->json(['message' => 'Evento de seguridad registrado.'], 201);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['error' => 'Error al registrar el evento.'], 500);
        }
    }
}
