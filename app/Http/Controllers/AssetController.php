<?php
/*-- app/Http/Controllers/AssetController.php */
namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;

class AssetController extends Controller
{

    // app/Http/Controllers/AssetController.php

    public function index(Request $request)
    {
        $query = Asset::query();

        // Si se activan los eliminados, incluirlos
        if ($request->boolean('conEliminados')) {
            $query->withTrashed();
        }

        // Aplicar filtros dinámicos si están presentes
        $filters = $request->only(['status', 'type']);

        foreach ($filters as $field => $value) {
            if (!empty($value)) {
                $query->where($field, $value);
            }
        }

        $assets = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString(); // Mantener filtros en la paginación

        return view('inventario.index', compact('assets'));
    }


    // Formulario de creación de activos
    public function create()
    {
        $users = \App\Models\User::orderBy('name')->get();
        return view('inventario.create', compact('users'));
    }
     // Almacenamiento de activos
    public function store(StoreAssetRequest $request)
    {
        $data = $request->validated();

        // 1. Buscar si ya hay un activo eliminado con ese serial
        $activoEliminado = Asset::onlyTrashed()
            ->where('serial_number', $data['serial_number'])
            ->first();

        if ($activoEliminado) {
            return redirect()
                ->route('inventario.confirmRestore', $activoEliminado->id)
                ->with('info', 'Ya existe un activo eliminado con ese serial. ¿Deseas restaurarlo?');
        }

    // 2. Si no existe, ahora sí lo creamos
        Asset::create($data);

        return redirect()
            ->route('inventario.index')
            ->with('success', 'Activo registrado exitosamente.');



    Asset::create($data);

    return redirect()
        ->route('inventario.index')
        ->with('success', 'Activo registrado exitosamente.');

    }
// Mostrar detalles de un activo
    public function show(Asset $asset)
    {
        return view('inventario.show', compact('asset'));
    }
// Formulario de edición de activos
    public function edit(Asset $asset)
    {
        $users = \App\Models\User::orderBy('name')->get();
        return view('inventario.edit', compact('asset', 'users'));
    }
// Actualización de activos
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->validated());

        return redirect()
            ->route('inventario.index')
            ->with('success', 'Activo actualizado correctamente.');
    }
// Confirmación de eliminación de activos
    public function destroy(Asset $asset)
    {
        return view('inventario.confirm_delete', compact('asset'));
    }
// Confirmación de eliminación de activos
    public function deleteConfirm(Request $request, Asset $asset)
    {
        $asset->delete();

        return redirect()
            ->route('inventario.index')
            ->with('success', 'Activo eliminado correctamente.');
    }
// Restauración de activos eliminados
    public function restore($id)
    {
        $asset = Asset::withTrashed()->findOrFail($id);
        $asset->restore();

        return redirect()
            ->route('inventario.index')
            ->with('success', 'Activo restaurado correctamente.');
    }

    // Confirmación de restauración de activos eliminados
    public function confirmRestore($id)
{
    $asset = Asset::onlyTrashed()->findOrFail($id);

    return view('inventario.confirm_restore', compact('asset'));
}

}
