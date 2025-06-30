<?php

namespace App\Http\Controllers;

use App\Models\{Loan, Asset, User, Signature, GateLog, LoanStatus};
use App\Http\Requests\StoreLoanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class LoanController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Devuelve el ID de un estado por nombre.
     */
    protected function getStatusId(string $name): ?int
    {
        return LoanStatus::where('name', $name)->value('id');
    }

    /**
     * Vista principal de préstamos.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Loan::with(['asset', 'status', 'user'])->latest();

        // Filtrar si es instructor
        if ($user->role?->name === 'instructor') {
            $query->where('user_id', $user->id);
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->whereHas('status', fn($q) => $q->where('name', $request->estado));
        }

        $loans = $query->paginate(10)->withQueryString();

        return view('prestamos.index', compact('loans'));
    }

    /**
     * Formulario de solicitud de préstamo.
     */
    public function create()
    {
        $assetsDisponibles = Asset::where('status', 'Disponible')
            ->where('loanable', true)
            ->whereNotIn('id', Loan::whereHas('status', fn($q) => $q->where('name', '!=', 'devuelto'))->pluck('asset_id'))
            ->get();

        $loansActivos = Loan::with(['asset', 'user', 'status'])
            ->whereHas('status', fn($q) => $q->where('name', 'entregado'))
            ->latest('delivered_at')
            ->get()
            ->map(function ($loan) {
                $loan->expected_return = optional($loan->delivered_at)?->copy()->addDays(3);
                $loan->is_late = now()->gt($loan->expected_return);
                return $loan;
            });

        return view('prestamos.solicitar', compact('assetsDisponibles', 'loansActivos'));
    }

    /**
     * Guarda una nueva solicitud de préstamo.
     */
    public function store(StoreLoanRequest $request)
    {
        try {
            $userId = $request->user()?->id;

            if (!$userId) {
                return back()->with('error', 'No se pudo identificar al usuario.');
            }

            // Validar que no esté en préstamo actual
            $activoOcupado = Loan::where('asset_id', $request->asset_id)
                ->whereHas('status', fn($q) => $q->where('name', '!=', 'devuelto'))
                ->exists();

            if ($activoOcupado) {
                return back()->with('error', 'Este activo ya tiene un préstamo activo.');
            }

            DB::beginTransaction();

            $loan = Loan::create([
                'user_id'      => $userId,
                'asset_id'     => $request->asset_id,
                'status_id'    => $this->getStatusId('solicitado'),
                'requested_at' => now(),
                'notes'        => $request->notes,
            ]);

            $loan->details()->create($request->only([
                'tipo_de_uso', 'ficha', 'programa', 'instructor',
                'cargo', 'departamento', 'proposito', 'sede',
                'hora_entrega', 'cantidad'
            ]));

            DB::commit();

            return redirect()->route('prestamos.index')->with('success', 'Solicitud registrada correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->with('error', 'Error al registrar el préstamo.');
        }
    }

    /**
     * Detalle del préstamo.
     */
public function show($id)
{
    try {
        // ⚠️ Consulta explícita del préstamo con todas las relaciones
        $loan = Loan::with([
            'user' => fn($q) => $q->withTrashed(),
            'asset' => fn($q) => $q->withTrashed(),
            'status',
            'details',
            'signatures.user'
        ])->findOrFail($id);

        $this->authorize('view', $loan);

        return view('prestamos.show', compact('loan'));

    } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
        return redirect()->route('prestamos.index')->with('error', 'No tienes permiso para ver este préstamo.');
    } catch (\Throwable $e) {
        return back()->with('error', 'Error inesperado: ' . $e->getMessage());
    }
}







    /**
     * Aprueba un préstamo.
     */
    public function approve(Loan $loan)
    {
        try {
            $this->authorize('approve', $loan);

            $loan->update([
                'status_id'   => $this->getStatusId('aprobado'),
                'approved_at' => now(),
            ]);

            return back()->with('success', 'Préstamo aprobado correctamente.');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Error al aprobar el préstamo.');
        }
    }

    /**
     * Registrar entrega con firma.
     */
public function checkOut(Request $request, Loan $loan)
{
    try {
        $this->authorize('deliver', $loan);

        // ✅ Validación explícita para evitar acceso nulo
        if (!$loan->status || $loan->status->name !== 'aprobado') {
            return back()->with('error', 'El préstamo aún no está aprobado.');
        }

        $request->validate([
            'signature' => 'required|file|mimes:png,svg|max:1024'
        ]);

        $path = $request->file('signature')->store('signatures', 'public');

        $loan->signatures()->create([
            'user_id'        => Auth::id(), //linea 195
            'type'           => 'entrega',
            'signature_path' => $path,
        ]);

        $loan->update([
            'status_id'    => $this->getStatusId('entregado'),
            'delivered_at' => now(),
        ]);

        return back()->with('success', 'Entrega registrada.');
    } catch (\Exception $e) {
        report($e);
        return back()->with('error', 'Error al registrar la entrega.');
    }
}


    /**
     * Registrar devolución con firma.
     */
public function checkIn(Request $request, Loan $loan)
{
    try {
        $this->authorize('returnAsset', $loan);

        // ✅ Validación explícita para prevenir error de null
        if (!$loan->status || $loan->status->name !== 'entregado') {
            return back()->with('error', 'El préstamo no ha sido entregado todavía.');
        }

        $request->validate([
            'signature' => 'required|file|mimes:png,svg|max:1024'
        ]);

        $path = $request->file('signature')->store('signatures', 'public');

        $loan->signatures()->create([
            'user_id'        => Auth::id(), //linea 233
            'type'           => 'devolucion',
            'signature_path' => $path,
        ]);

        $loan->update([
            'status_id'   => $this->getStatusId('devuelto'),
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Devolución registrada.');
    } catch (\Exception $e) {
        report($e);
        return back()->with('error', 'Error al registrar la devolución.');
    }
}

}
