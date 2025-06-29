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
     * Devuelve el ID del estado de préstamo dado su nombre.
     */
    protected function getStatusId(string $name): ?int
    {
        return LoanStatus::where('name', $name)->value('id');
    }

    /**
     * Lista todos los préstamos según el rol.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Loan::with(['asset', 'status', 'user'])->orderByDesc('created_at');

        if ($user->role->name === 'instructor') {
            $query->where('user_id', $user->id);
        }

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
        $prestados = Loan::whereHas('status', fn($q) => $q->where('name', 'entregado'))
                         ->pluck('asset_id')->toArray();

        $assetsDisponibles = Asset::where('status', 'Disponible')
            ->where('loanable', true)
            ->whereNotIn('id', Loan::whereHas('status', fn($q) => $q->where('name', '!=', 'devuelto'))->pluck('asset_id'))
            ->get();


        $loansActivos = Loan::with(['asset', 'user', 'status'])
            ->whereHas('status', fn($q) => $q->where('name', 'entregado'))
            ->orderByDesc('delivered_at')
            ->get()
            ->map(function ($loan) {
                $loan->expected_return = optional($loan->delivered_at)?->copy()->addDays(3);
                $loan->is_late = now()->gt($loan->expected_return);
                return $loan;
            });

        return view('prestamos.solicitar', compact('assetsDisponibles', 'loansActivos'));
    }

    /**
     * Registra una nueva solicitud de préstamo.
     */
    public function store(StoreLoanRequest $request)
    {
        $user = $request->user();

        $activoOcupado = Loan::where('asset_id', $request->asset_id)
            ->whereHas('status', fn($q) => $q->where('name', '!=', 'devuelto'))
            ->exists();

        if ($activoOcupado) {
            return back()->with('error', 'Este activo ya tiene un préstamo activo.');
        }

        DB::beginTransaction();

        try {
            $loan = Loan::create([
                'user_id'      => $user->id,
                'asset_id'     => $request->asset_id,
                'status_id'    => $this->getStatusId('solicitado'),
                'requested_at' => now(),
                'notes'        => $request->notes,
            ]);

            $loan->details()->create($request->only([
                'tipo_de_uso', 'ficha', 'programa', 'instructor', 'cargo',
                'departamento', 'proposito', 'sede', 'hora_entrega', 'cantidad'
            ]));

            DB::commit();

            return redirect()->route('prestamos.index')->with('success', 'Solicitud de préstamo registrada.');

        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return back()->with('error', 'Error al registrar el préstamo.');
        }
    }

    /**
     * Muestra los detalles de un préstamo.
     */
    public function show(Loan $loan)
    {
        $loan->load(['asset', 'user', 'status', 'details', 'signatures.user']);

        $this->authorize('view', $loan);

        return view('prestamos.show', compact('loan'));
    }

    /**
     * Aprueba un préstamo.
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

    /**
     * Firma de entrega del activo.
     */
    public function checkOut(Request $request, Loan $loan)
    {
        $this->authorize('deliver', $loan);

        if ($loan->status->name !== 'aprobado') {
            return back()->with('error', 'El préstamo no ha sido aprobado.');
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
     * Firma de devolución del activo.
     */
    public function checkIn(Request $request, Loan $loan)
    {
        $this->authorize('returnAsset', $loan);

        if ($loan->status->name !== 'entregado') {
            return back()->with('error', 'Este préstamo aún no ha sido entregado.');
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
}
