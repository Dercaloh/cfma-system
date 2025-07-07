<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssetSyncController;
use App\Models\Location\Location;


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::post('/assets', [AssetSyncController::class, 'store']);
    Route::put('/assets/{id}', [AssetSyncController::class, 'update']);
});
Route::get('/branches/{branch}/locations', function ($branch) {
    return Location::whereHas('branches', function ($q) use ($branch) {
        $q->where('id', $branch);
    })->select('id', 'name', 'location_code')->orderBy('name')->get();
});
