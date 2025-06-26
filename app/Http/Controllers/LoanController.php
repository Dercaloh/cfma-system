<?php
// LoanController.php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Asset;
use App\Models\LoanStatus;
use App\Models\Signature;
use App\Models\GateLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;

class LoanController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Helper: obtiene el ID de un estado de préstamo.
     */
    protected function getStatusId(string $name): ?int
    {
        return LoanStatus::where('name', $name)->value('id');
    }

    // ... index(), create(), store(), show(), edit(), update(), destroy() ...

    /**
     * Check-Out: registro de entrega y firma.
     */
    public function checkOut(Request $request, Loan $loan)
    {
        $this->authorize('deliver', $loan);

        if ($loan->status->name !== 'aprobado') {
            return back()->with('error', 'Solo préstamos aprobados pueden entregarse.');
        }

        $request->validate([
            'signature' => 'required|file|mimes:png,svg|max:1024'
        ]);

        $path = $request->file('signature')->store('signatures', 'public');

        $loan->signatures()->create([
            'user_id'        => Auth::id(),
            'type'           => 'entrega',
            'signature_path' => $path,
        ]);

        $loan->update([
            'status_id'    => $this->getStatusId('entregado'),
            'delivered_at' => now(),
        ]);

        return back()->with('success', 'Entrega registrada correctamente.');
    }

    /**
     * Check-In: registro de devolución y firma.
     */
    public function checkIn(Request $request, Loan $loan)
    {
        $this->authorize('returnAsset', $loan);

        if ($loan->status->name !== 'entregado') {
            return back()->with('error', 'El préstamo aún no ha sido entregado.');
        }

        $request->validate([
            'signature' => 'required|file|mimes:png,svg|max:1024'
        ]);

        $path = $request->file('signature')->store('signatures', 'public');

        $loan->signatures()->create([
            'user_id'        => Auth::id(),
            'type'           => 'devolucion',
            'signature_path' => $path,
        ]);

        $loan->update([
            'status_id'   => $this->getStatusId('devuelto'),
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Devolución registrada correctamente.');
    }

    /**
     * Aprobar préstamo.
     */
    public function approve(Loan $loan)
    {
        $this->authorize('approve', $loan);

        $loan->update([
            'status_id'   => $this->getStatusId('aprobado'),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Préstamo aprobado.');
    }
}
