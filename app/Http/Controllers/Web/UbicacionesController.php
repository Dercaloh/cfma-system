<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Locations\Location;
use Illuminate\Http\JsonResponse;

class UbicacionesController extends Controller
{
    /**
     * Retorna las ubicaciones activas según la sede (branch_id).
     */
    public function porSede(int $branchId): JsonResponse
    {
        $locations = Location::where('branch_id', $branchId)
            ->where('active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'success'   => true,
            'locations' => $locations,
        ]);
    }
}
