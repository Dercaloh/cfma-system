<?php

namespace App\Http\Controllers\Api;

use App\Models\Assets\Asset;
use App\Models\Assets\AssetHardwareDetail;
use App\Models\Assets\AssetSoftwareDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\StoreAssetRequest;
use App\Http\Requests\Api\UpdateAssetRequest;

class AssetSyncController extends Controller
{
    /**
     * Almacena un nuevo activo con sus detalles opcionales de hardware y software.
     */
    public function store(StoreAssetRequest $request)
    {
        DB::beginTransaction();

        try {
            $asset = Asset::create([
                'name'           => $request->name,
                'serial_number'  => $request->serial_number,
                'placa'          => $request->placa,
                'type_id'        => $request->type_id,
                'ownership'      => $request->ownership ?? 'Centro',
                'brand'          => $request->brand,
                'model'          => $request->model,
                'year_purchased' => $request->year_purchased,
                'status'         => $request->status ?? 'Disponible',
                'condition'      => $request->condition ?? 'Bueno',
                'location_id'    => $request->location_id,
                'loanable'       => $request->loanable ?? true,
                'movable'        => $request->movable ?? false,
                'assigned_to'    => $request->assigned_to,
                'description'    => $request->description,
                'created_by'     => Auth::id(),
            ]);

            if ($request->filled('hardware')) {
                AssetHardwareDetail::create([
                    ...$request->hardware,
                    'asset_id'   => $asset->id,
                    'created_by' => Auth::id(),
                ]);
            }

            if ($request->filled('software')) {
                foreach ($request->software as $item) {
                    AssetSoftwareDetail::create([
                        ...$item,
                        'asset_id'   => $asset->id,
                        'created_by' => Auth::id(),
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Activo creado correctamente.'], 201);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error al guardar el activo',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualiza un activo existente con información nueva.
     */
    public function update(UpdateAssetRequest $request, int $id)
    {
        DB::beginTransaction();

        try {
            $asset = Asset::findOrFail($id);
            $asset->update([
                'name'        => $request->name,
                'ownership'   => $request->ownership ?? $asset->ownership,
                'type_id'     => $request->type_id,
                'brand'       => $request->brand,
                'model'       => $request->model,
                'year_purchased' => $request->year_purchased,
                'status'      => $request->status,
                'condition'   => $request->condition,
                'location_id' => $request->location_id,
                'loanable'    => $request->loanable,
                'movable'     => $request->movable,
                'assigned_to' => $request->assigned_to,
                'description' => $request->description,
                'updated_by'  => Auth::id(),
            ]);

            if ($request->filled('hardware')) {
                $hardware = AssetHardwareDetail::where('asset_id', $id)->first();
                if ($hardware) {
                    $hardware->update([
                        ...$request->hardware,
                        'updated_by' => Auth::id(),
                    ]);
                } else {
                    AssetHardwareDetail::create([
                        ...$request->hardware,
                        'asset_id'   => $id,
                        'created_by' => Auth::id(),
                    ]);
                }
            }

            if ($request->filled('software')) {
                // Estrategia simple: eliminar y volver a insertar software
                AssetSoftwareDetail::where('asset_id', $id)->delete();
                foreach ($request->software as $item) {
                    AssetSoftwareDetail::create([
                        ...$item,
                        'asset_id'   => $id,
                        'created_by' => Auth::id(),
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Activo actualizado correctamente.'], 200);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error al actualizar el activo',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }
}
