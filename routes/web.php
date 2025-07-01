<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\{
    ProfileController,
    AssetController,
    DocumentController,
    LoanController,
    GateController,
    ExitPassController,
    UserPolicyController,
    UserSecurityLogController
};

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
| Redirección dinámica tras login
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

Route::middleware(['auth'])->group(function () {
    Route::post('/politicas/aceptar', [UserPolicyController::class, 'store'])->name('politicas.store');
    Route::post('/seguridad/log', [UserSecurityLogController::class, 'store'])->name('seguridad.log.store');
});

/*
|--------------------------------------------------------------------------
| Perfil de usuario
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Gestión de préstamos
|--------------------------------------------------------------------------
*/


// Solo quienes pueden solicitar
Route::middleware(['auth', 'role:instructor,subdirector,supervisor,administrador'])->group(function () {
    Route::get('/prestamos/solicitar', [LoanController::class, 'create'])->name('prestamos.solicitar');
});

// Acciones disponibles para todos los autenticados
Route::middleware('auth')->group(function () {
    Route::resource('/prestamos', LoanController::class)->names('prestamos');
    Route::get('/prestamos/{loan}/debug', [LoanController::class, 'show'])->name('prestamos.debug');
    Route::post('/prestamos/{loan}/aprobar', [LoanController::class, 'approve'])->name('prestamos.aprobar');
    Route::post('/prestamos/{loan}/entregar', [LoanController::class, 'checkOut'])->name('prestamos.entregar');
    Route::post('/prestamos/{loan}/devolver', [LoanController::class, 'checkIn'])->name('prestamos.devolver');
});

/*
|--------------------------------------------------------------------------
| Módulo de portería
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:portería'])->group(function () {
    Route::view('/porteria/dashboard', 'porteria.dashboard')->name('porteria.dashboard');
    Route::view('/porteria/checkin', 'prestamos.checkin')->name('porteria.checkin');      // Renombrado
    Route::view('/porteria/checkout', 'prestamos.checkout')->name('porteria.checkout');   // Renombrado

    Route::post('/porteria/{asset}/registro', [GateController::class, 'log'])->name('porteria.registro');
});

/*
|--------------------------------------------------------------------------
| Rutas por Rol
|--------------------------------------------------------------------------
*/
// ADMINISTRADOR
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::resource('/inventario', AssetController::class)
        ->names('inventario')
        ->parameters(['inventario' => 'asset']);
    Route::get('/inventario', [AssetController::class, 'index'])->name('inventario.index');
    Route::get('/inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
    Route::delete('/inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
    Route::get('/inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
    Route::patch('/inventario/{id}/restaurar', [AssetController::class, 'restore'])->name('inventario.restore');
    Route::post('/inventario/{asset}/documentos', [DocumentController::class, 'store'])->name('documentos.store');
});

// SUBDIRECTOR
Route::middleware(['auth', 'role:subdirector'])->group(function () {
    Route::view('/subdirector/dashboard', 'subdirector.dashboard')->name('subdirector.dashboard');
    Route::view('/prestamos/aprobar', 'prestamos.aprobar')->name('prestamos.aprobar');
});

// SUPERVISOR
Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::view('/supervisor/dashboard', 'supervisor.dashboard')->name('supervisor.dashboard');
});

// INSTRUCTOR
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::view('/instructor/dashboard', 'instructor.dashboard')->name('instructor.dashboard');
});

/*
|--------------------------------------------------------------------------
| Actas (Exit Pass)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/actas/{exitPass}', [ExitPassController::class, 'show'])->name('exit_passes.show');
    Route::get('/actas/{exitPass}/pdf', [ExitPassController::class, 'generatePDF'])->name('exit_passes.pdf');
});

/*
|--------------------------------------------------------------------------
| Breeze (Laravel auth)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
