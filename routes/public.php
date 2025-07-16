<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\Policy\UserPolicyController;
use App\Http\Controllers\ComponentTestController;

Route::get('/test-components', [ComponentTestController::class, 'index'])
    ->name('components.test'); // sin middleware de autenticación



Route::get('/', fn() => Auth::check() ? redirect()->route('dashboard') : view('welcome'))->name('home');

// Políticas de protección de datos (público + autenticado)
Route::get('/politicas/aceptar', [UserPolicyController::class, 'show'])->name('politicas.show');
Route::middleware('auth')->post('/politicas/aceptar', [UserPolicyController::class, 'store'])->name('politicas.store');
