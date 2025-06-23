<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetController;

/*
|--------------------------------------------------------------------------
| Ruta pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Ruta común después de login (redirige según rol)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function (Request $request) {
    $user = $request->user();

    return match ($user->role->name) {
        'administrador' => redirect()->route('admin.dashboard'),
        'subdirector'   => redirect()->route('subdirector.dashboard'),
        'supervisor'    => redirect()->route('supervisor.dashboard'),
        'instructor'    => redirect()->route('instructor.dashboard'),
        'portería'      => redirect()->route('porteria.dashboard'),
        default         => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Gestión de Perfil (común para todos los usuarios autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Dashboards y Vistas por Rol
|--------------------------------------------------------------------------
| Cada grupo usa middleware 'auth' + 'role' correspondiente.
| Las vistas aún no existen, se deben crear en:
| resources/views/{rol}/dashboard.blade.php
|--------------------------------------------------------------------------
*/

// Administrador
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    // Gestión de inventario de activos
    Route::resource('/inventario', AssetController::class)
        ->names('inventario')
        ->parameters(['inventario' => 'asset']);
});

// Subdirector
Route::middleware(['auth', 'role:subdirector'])->group(function () {
    Route::view('/subdirector/dashboard', 'subdirector.dashboard')->name('subdirector.dashboard');
    Route::view('/prestamos/aprobar', 'prestamos.aprobar')->name('prestamos.aprobar');
});

// Supervisor
Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::view('/supervisor/dashboard', 'supervisor.dashboard')->name('supervisor.dashboard');
});

// Instructor
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::view('/instructor/dashboard', 'instructor.dashboard')->name('instructor.dashboard');
    Route::view('/prestamos/solicitar', 'prestamos.solicitar')->name('prestamos.solicitar');
});

// Portería
Route::middleware(['auth', 'role:portería'])->group(function () {
    Route::view('/porteria/dashboard', 'porteria.dashboard')->name('porteria.dashboard');
    Route::view('/prestamos/checkin', 'prestamos.checkin')->name('prestamos.checkin');
    Route::view('/prestamos/checkout', 'prestamos.checkout')->name('prestamos.checkout');
});

/*
|--------------------------------------------------------------------------
| Autenticación generada por Breeze
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
