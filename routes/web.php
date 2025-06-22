<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Rutas Web Públicas
|--------------------------------------------------------------------------
| Estas rutas pueden ser protegidas con auth en Fase 2
*/

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
