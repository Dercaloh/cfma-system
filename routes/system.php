<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\ExitPassController;
use App\Http\Controllers\Security\UserSecurityLogController;

Route::middleware('auth')->group(function () {

    // Registro de actividad
    Route::post('/seguridad/log', [UserSecurityLogController::class, 'store'])->name('seguridad.log.store');

    // Actas de salida
    Route::prefix('actas')->name('exit_passes.')->group(function () {
        Route::get('{exitPass}', [ExitPassController::class, 'show'])->name('show');
        Route::get('{exitPass}/pdf', [ExitPassController::class, 'generatePDF'])->name('pdf');
    });

});
