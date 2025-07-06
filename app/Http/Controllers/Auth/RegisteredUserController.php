<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User, AuditLog, UserPolicy};
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Procesa el registro de un nuevo usuario.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'accept_terms' => ['required', 'accepted'],
        ]);

        // Separar nombre y apellido
        $nameParts = explode(' ', trim($request->name), 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';
        $policyVersion = env('PRIVACY_POLICY_VERSION', '1.0');

        DB::beginTransaction();
        try {
            // Crear el usuario
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => strtolower(preg_replace('/\s+/', '.', $firstName . '.' . $lastName)),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'activo',
                'account_valid_from' => now(),
                'consent_data_processing' => true,
                'consent_timestamp' => now(),
                'privacy_policy_version' => $policyVersion,
            ]);

            // Registrar aceptación de política de privacidad
            UserPolicy::create([
                'user_id' => $user->id,
                'policy_name' => 'Política de privacidad',
                'policy_version' => $policyVersion,
                'accepted_at' => now(),
                'accepted_ip' => request()->ip(),
            ]);

            // Registrar en auditoría como evento del sistema (sin usuario autenticado)
            AuditLog::create([
                'user_id' => null,
                'action' => 'create_user',
                'module' => 'Autenticación',
                'details' => json_encode([
                    'registro' => 'nuevo usuario',
                    'usuario_id_generado' => $user->id,
                    'correo' => $user->email,
                ]),
                'ip_address' => request()->ip(),
                'user_agent' => $request->header('User-Agent'),
                'is_system_event' => true,
            ]);

            DB::commit();

            // Evento de registro y autenticación automática
            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('register')->withErrors([
                'registro' => 'Error en el proceso de registro.',
            ]);
        }
    }
}
