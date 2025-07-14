<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assets\GateController;

Route::middleware(['auth', 'role:Portería'])->prefix('porteria')->name('porteria.')->group(function () {
    Route::view('/dashboard', 'porteria.dashboard')->name('dashboard');
    Route::view('/checkin', 'prestamos.checkin')->name('checkin');
    Route::view('/checkout', 'prestamos.checkout')->name('checkout');
    Route::post('{asset}/registro', [GateController::class, 'log'])->name('registro');
});
