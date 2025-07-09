<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
 use App\Models\Policies\UserPolicy;
class ProfileController extends Controller
{
    /**
     * 📄 [Vista] Muestra el formulario del perfil del usuario autenticado.
     * @return View
     */
    public function edit(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * 🔄 [Actualización] Procesa la edición del perfil.
     * Protegido por middleware y validación robusta (Ley 1581, ISO 27001).
     *
     * @param  ProfileUpdateRequest  $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $user = $request->user();
            $validated = $request->validated();

            // 🌐 Si cambia el correo, reinicia verificación (normativa antifraude)
            if ($validated['email'] !== $user->email) {
                $user->email_verified_at = null;
            }

            // 🧾 Asignación explícita campo por campo (auditabilidad + control)
            $user->first_name = $validated['first_name'];
            $user->last_name = $validated['last_name'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];

            // ✅ Consentimiento para tratamiento de datos personales (Ley 1581)
            if (array_key_exists('consent_data_processing', $validated)) {
                $user->consent_data_processing = $validated['consent_data_processing'];
            }

            $user->save();

            // 📚 (Opcional) Registra en logs de auditoría (cumple ISO 27001)
            Log::info("Perfil actualizado", [
                'user_id' => $user->id,
                'ip' => $request->ip(),
                'agent' => $request->header('User-Agent'),
            ]);

            return Redirect::route('profile.edit')->with('status', 'profile-updated');

        } catch (\Throwable $e) {
            Log::error("Error al actualizar perfil", [
                'message' => $e->getMessage(),
                'user_id' => $request->user()->id ?? null,
            ]);

            return back()->withErrors([
                'update' => 'Ocurrió un error al guardar los cambios. Intenta nuevamente o contacta al equipo TIC.',
            ]);
        }
    }

    /**
     * ⚠️ [Eliminación] Elimina la cuenta del usuario autenticado tras confirmar su contraseña.
     * Conforme a Ley 1581 (derecho al olvido) y seguridad institucional.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */


public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
        'consent_data_processing' => ['accepted'],
    ]);

    $user = $request->user();

    // 🔐 Registrar política aceptada al eliminar cuenta
    UserPolicy::create([
        'user_id' => $user->id,
        'policy_name' => 'tratamiento_datos',
        'policy_version' => '1.0',
        'accepted_at' => now(),
        'accepted_ip' => $request->ip(),
        'accepted_user_agent' => $request->header('User-Agent'),
    ]);

    Log::warning("Cuenta eliminada por el usuario", [
        'user_id' => $user->id,
        'ip' => $request->ip(),
        'agent' => $request->header('User-Agent'),
    ]);

    Auth::logout();
    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/')->with('status', 'account-deleted');
}


    /**
 * 🔐 [Seguridad] Actualiza la contraseña del usuario autenticado.
 * Cumple con Requisitos de la Ley 1581 y la ISO 27001:2025.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function updatePassword(Request $request): RedirectResponse
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'string', 'min:8', 'confirmed'], // Puedes añadir reglas adicionales
    ]);

    $user = $request->user();
    $user->password = bcrypt($request->password);
    $user->save();

    // 🗒️ Recomendación: Registra en bitácora institucional (ISO 27001)
    Log::info('Contraseña actualizada por el usuario', [
        'user_id' => $user->id,
        'ip' => $request->ip(),
        'agent' => $request->header('User-Agent'),
    ]);

    return back()->with('status', 'password-updated');
}

}
