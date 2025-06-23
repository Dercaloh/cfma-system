<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Asset;
use App\Models\User;
use App\Models\LoanStatus;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar préstamos
    public function index()
    {
        $this->authorize('viewAny', Loan::class);

        $loans = Loan::with(['user', 'asset', 'status'])->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    // Mostrar formulario de solicitud
    public function create()
    {
        $this->authorize('create', Loan::class);

        $assets = Asset::where('status', 'Disponible')->get();
        return view('loans.create', compact('assets'));
    }

    // Almacenar solicitud
    public function store(Request $request)
    {
        $this->authorize('create', Loan::class);

        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        Loan::create([
            'user_id' => auth()->id(),
            'asset_id' => $request->asset_id,
            'status_id' => LoanStatus::where('name', 'pendiente')->first()->id,
            'notes' => $request->notes,
            'requested_at' => now(),
        ]);

        return redirect()->route('loans.index')->with('success', 'Solicitud registrada correctamente.');
    }

    // Ver detalles de un préstamo
    public function show(Loan $loan)
    {
        $this->authorize('view', $loan);

        $loan->load(['user', 'asset', 'status']);
        return view('loans.show', compact('loan'));
    }

    // Editar préstamo
    public function edit(Loan $loan)
    {
        $this->authorize('update', $loan);

        $assets = Asset::where('status', 'Disponible')->orWhere('id', $loan->asset_id)->get();
        return view('loans.edit', compact('loan', 'assets'));
    }

    // Actualizar préstamo
    public function update(Request $request, Loan $loan)
    {
        $this->authorize('update', $loan);

        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $loan->update([
            'asset_id' => $request->asset_id,
            'notes' => $request->notes,
        ]);

        return redirect()->route('loans.index')->with('success', 'Préstamo actualizado.');
    }

    // Eliminar préstamo (solo si no ha sido entregado)
    public function destroy(Loan $loan)
    {
        $this->authorize('delete', $loan);

        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Préstamo eliminado.');
    }

    // Aprobar préstamo
    public function approve(Loan $loan)
    {
        $this->authorize('approve', $loan);

        $loan->update([
            'status_id' => LoanStatus::where('name', 'aprobado')->first()->id,
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Préstamo aprobado.');
    }

    // Registrar devolución
    public function return(Loan $loan)
    {
        $this->authorize('returnAsset', $loan);

        $loan->update([
            'status_id' => LoanStatus::where('name', 'devuelto')->first()->id,
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Activo devuelto correctamente.');
    }
}
