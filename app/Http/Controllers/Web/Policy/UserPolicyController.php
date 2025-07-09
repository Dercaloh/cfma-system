<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Policies\PolicyView;
use App\Models\Policies\UserPolicy;

class UserPolicyController extends Controller
{
    /**
     * Muestra la política de protección de datos.
     * Registra visualización anónima o autenticada en la bitácora.
     */
    public function show()
    {
        PolicyView::create([
            'ip_address'      => request()->ip(),
            'user_agent'      => request()->userAgent(),
            'policy_version'  => env('PRIVACY_POLICY_VERSION', '1.0.0'),
            'user_id'         => Auth::id(), // null si no está autenticado
            'viewed_at'       => now(),
        ]);

        return view('politicas.show');
    }

    /**
     * Almacena la aceptación formal de la política.
     */
    public function store(Request $request)
    {
        $request->validate([
            'policy_name'    => 'required|string|max:100',
            'policy_version' => 'required|string|max:20',
        ]);

        try {
            UserPolicy::create([
                'user_id'             => Auth::id(),
                'policy_name'         => $request->input('policy_name'),
                'policy_version'      => $request->input('policy_version'),
                'accepted_at'         => now(),
                'accepted_ip'         => $request->ip(),
                'accepted_user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Has aceptado correctamente la política de tratamiento de datos personales.');
        } catch (\Throwable $e) {
            report($e);

            return back()->withErrors([
                'error' => 'Ocurrió un error al registrar tu aceptación. Intenta nuevamente o contacta al administrador.',
            ]);
        }
    }
}
