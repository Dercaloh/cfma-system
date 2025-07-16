<?php
// GateController.php
namespace App\Http\Controllers\Assets;

use App\Models\Assets\Asset;
use App\Models\Assets\ExitPass;
use App\Models\Assets\GateLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class GateController extends Controller
{
    public function log(Request $request, Asset $asset)
    {
        $request->validate([
            'action' => ['required', 'in:salida,entrada'],
            'notes'  => ['nullable', 'string', 'max:1000'],
        ]);

        // ⚠️ Si es institucional sin cuentadante, requiere préstamo entregado
        if (!$asset->is_personal && !$asset->assigned_to) {
            $hasLoan = $asset->loans()
                ->whereHas('status', fn ($q) => $q->where('name', 'entregado'))
                ->exists();

            if (!$hasLoan) {
                return back()->with('error', 'Activo institucional sin préstamo entregado. Registro denegado.');
            }
        }

        // ✅ Registro básico del movimiento
        $gateLog = GateLog::create([
            'asset_id' => $asset->id,
            'user_id'  => Auth::id(),
            'action'   => $request->action,
            'notes'    => $request->notes,
        ]);

        // 🎯 Crear ExitPass si es salida institucional con cuentadante
        if ($request->action === 'salida' && !$asset->is_personal && $asset->assigned_to) {
            $cuentadante = $asset->cuentadante;

            ExitPass::firstOrCreate(
                ['gate_log_id' => $gateLog->id],
                [
                    'cuentadante'       => $cuentadante->name,
                    'cedula'            => $cuentadante->employee_id ?? '---',
                    'dependencia'       => 'Centro de Formación Minero Ambiental',
                    'permiso'           => 'institucional',
                    'autorizado_salida' => now()->format('Y-m-d H:i:s'),
                ]
            );
        }

        return back()->with('success', 'Movimiento registrado correctamente.');
    }
}
// End of file: app/Http/Controllers/GateController.php
