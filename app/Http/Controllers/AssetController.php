<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::orderBy('created_at', 'desc')->paginate(10);
        return view('inventario.index', compact('assets'));
    }

    public function create()
    {
        $users = \App\Models\User::orderBy('name')->get(); // todos los usuarios para asignar activo
        return view('inventario.create', compact('users'));
    }

    public function store(StoreAssetRequest $request)
    {
        Asset::create($request->validated());

        return redirect()
            ->route('inventario.index')
            ->with('success', 'Activo registrado exitosamente.');
    }

    public function show(Asset $asset)
    {
        return view('inventario.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $users = \App\Models\User::orderBy('name')->get(); // necesario para el select
        return view('inventario.edit', compact('asset', 'users'));
    }


    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->validated());

        return redirect()
            ->route('inventario.index')
            ->with('success', 'Activo actualizado correctamente.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()
            ->route('inventario.index')
            ->with('success', 'Activo eliminado correctamente.');
    }
}
