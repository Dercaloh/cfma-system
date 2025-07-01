<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPolicy;
use Illuminate\Support\Facades\Auth;

class UserPolicyController extends Controller
{
    /**
     * Almacena una nueva aceptación de política
     */
    public function store(Request $request)
    {
        $request->validate([
            'policy_name'    => 'required|string|max:100',
            'policy_version' => 'required|string|max:20',
        ]);

        try {
            UserPolicy::create([
                'user_id'        => Auth::id(),
                'policy_name'    => $request->input('policy_name'),
                'policy_version' => $request->input('policy_version'),
                'accepted_at'    => now(),
                'accepted_ip'    => $request->ip(),
            ]);

            return back()->with('success', 'Política aceptada correctamente.');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors('Error al registrar la aceptación de la política.');
        }
    }
}
