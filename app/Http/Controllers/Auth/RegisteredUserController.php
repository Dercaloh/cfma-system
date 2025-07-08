<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use app\Models\Policies\UserPolicy;
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
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Procesa el registro de un nuevo usuario.
     * Aplica cifrado, auditoría y clasificación institucional.
     *
     * @param Request $request
     * @return RedirectResponse
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
            // 🟢 Creación de usuario con cifrado seguro
            $user = User::create([
                'first_name' => $firstName,                       // 🟢 Público
                'last_name' => $lastName,                         // 🟢 Público
                'username' => strtolower(preg_replace('/\s+/', '.', $firstName . '.' . $lastName)), // 🟡 Clasificado
                'email' => $request->email,                       // 🟢 Público
                'password' => Hash::make($request->password),     // 🔴 Reservado (cifrado por Laravel)
                'status' => 'activo',                             // 🟡 Clasificado
                'account_valid_from' => now(),                    // 🟡 Clasificado
                'consent_data_processing' => true,                // 🟡 Clasificado
                'consent_timestamp' => now(),                     // 🟡 Clasificado
                'privacy_policy_version' => $policyVersion,       // 🟡 Clasificado
            ]);

            // 🟡 Registro de aceptación de política
            UserPolicy::create([
                'user_id' => $user->id,
                'policy_name' => 'Política de privacidad',
                'policy_version' => $policyVersion,
                'accepted_at' => now(),
                'accepted_ip' => $request->ip(),
            ]);

            // 🔴 Auditoría automatizada con Spatie
            activity()
                ->causedBy(null) // Evento del sistema (sin autenticación)
                ->performedOn($user)
                ->withProperties([
                    'accion' => 'Registro de nuevo usuario',
                    'email' => $user->email,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                ])
                ->event('created_user')
                ->log('Registro de usuario desde formulario público');

            DB::commit();

            // Evento del sistema + login automático
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
