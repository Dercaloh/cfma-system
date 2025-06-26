<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\GateController;

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
| Gestión de Préstamos
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('/prestamos', LoanController::class)->names('prestamos');
    Route::post('/prestamos/{loan}/aprobar', [LoanController::class, 'approve'])->name('prestamos.aprobar');
    Route::post('/prestamos/{loan}/entregar', [LoanController::class, 'checkOut'])->name('prestamos.entregar');
    Route::post('/prestamos/{loan}/devolver', [LoanController::class, 'checkIn'])->name('prestamos.devolver');
});

/*
|--------------------------------------------------------------------------
| Registro en Portería (solo portería)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:portería'])->group(function () {
    Route::post('/porteria/{asset}/registro', [GateController::class, 'log'])->name('porteria.registro');
});

/*
|--------------------------------------------------------------------------
| Dashboards y Vistas por Rol
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::resource('/inventario', AssetController::class)
        ->names('inventario')
        ->parameters(['inventario' => 'asset']);

    Route::get('/inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
    Route::delete('/inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
    Route::get('/inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
});

Route::middleware(['auth', 'role:subdirector'])->group(function () {
    Route::view('/subdirector/dashboard', 'subdirector.dashboard')->name('subdirector.dashboard');
    Route::view('/prestamos/aprobar', 'prestamos.aprobar')->name('prestamos.aprobar');
});

Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::view('/supervisor/dashboard', 'supervisor.dashboard')->name('supervisor.dashboard');
});

Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::view('/instructor/dashboard', 'instructor.dashboard')->name('instructor.dashboard');
    Route::view('/prestamos/solicitar', 'prestamos.solicitar')->name('prestamos.solicitar');
});

Route::middleware(['auth', 'role:portería'])->group(function () {
    Route::view('/porteria/dashboard', 'porteria.dashboard')->name('porteria.dashboard');
    Route::view('/prestamos/checkin', 'prestamos.checkin')->name('prestamos.checkin');
    Route::view('/prestamos/checkout', 'prestamos.checkout')->name('prestamos.checkout');
});

/*
|--------------------------------------------------------------------------
| Carga de documentos y restauración de activos
|--------------------------------------------------------------------------
*/
Route::post('/inventario/{asset}/documentos', [DocumentController::class, 'store'])
    ->name('documentos.store');

Route::patch('/inventario/{id}/restaurar', [AssetController::class, 'restore'])
    ->name('inventario.restore')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Breeze
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
