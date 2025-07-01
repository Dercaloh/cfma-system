<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssetSyncController;

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::post('/assets', [AssetSyncController::class, 'store']);
    Route::put('/assets/{id}', [AssetSyncController::class, 'update']);
});
