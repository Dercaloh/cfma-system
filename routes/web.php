<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    Web\DashboardController,
    Web\ProfileController,
    Web\Policy\UserPolicyController,
    Admin\UserRoleController,
    Admin\UserExportController,
    Web\Policy\PolicyViewController,
    Admin\AuditoriaController,
    Inventory\AssetController,
    Inventory\ExitPassController,
    Inventory\GateController,
    Documents\DocumentController,
    Loans\LoanController,
    Security\UserSecurityLogController,
    users\UsuarioController
};
use App\Http\Controllers\Web\UbicacionesController;

/*
|--------------------------------------------------------------------------
| Ruta pública principal y de bienvenida
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => Auth::check() ? redirect()->route('dashboard') : view('welcome'))->name('home');

// Políticas de protección de datos (acceso público y autenticado)
Route::get('/politicas/aceptar', [UserPolicyController::class, 'show'])->name('politicas.show');
Route::middleware('auth')->post('/politicas/aceptar', [UserPolicyController::class, 'store'])->name('politicas.store');

/*
|--------------------------------------------------------------------------
| Rutas autenticadas generales
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard dinámico por rol
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // Perfil y configuración
    Route::prefix('perfil')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Registro de actividad
    Route::post('/seguridad/log', [UserSecurityLogController::class, 'store'])->name('seguridad.log.store');

    // Actas de salida
    Route::prefix('actas')->name('exit_passes.')->group(function () {
        Route::get('{exitPass}', [ExitPassController::class, 'show'])->name('show');
        Route::get('{exitPass}/pdf', [ExitPassController::class, 'generatePDF'])->name('pdf');
    });
});

/*
|--------------------------------------------------------------------------
| Préstamos: Solicitud y gestión
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Aprendiz,Funcionario,Instructor,Vocero Principal,Vocero Suplente'])->group(function () {
    Route::get('/prestamos/solicitar', [LoanController::class, 'create'])->name('prestamos.solicitar');
});

Route::middleware('auth')->prefix('prestamos')->name('prestamos.')->group(function () {
    Route::resource('/', LoanController::class)->parameters(['' => 'loan']);
    Route::get('{loan}/debug', [LoanController::class, 'show'])->name('debug');
    Route::post('{loan}/aprobar', [LoanController::class, 'approve'])->name('aprobar');
    Route::post('{loan}/entregar', [LoanController::class, 'checkOut'])->name('entregar');
    Route::post('{loan}/devolver', [LoanController::class, 'checkIn'])->name('devolver');
});

/*
|--------------------------------------------------------------------------
| Portería (rol exclusivo)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Portería'])->prefix('porteria')->name('porteria.')->group(function () {
    Route::view('/dashboard', 'porteria.dashboard')->name('dashboard');
    Route::view('/checkin', 'prestamos.checkin')->name('checkin');
    Route::view('/checkout', 'prestamos.checkout')->name('checkout');
    Route::post('{asset}/registro', [GateController::class, 'log'])->name('registro');
});

/*
|--------------------------------------------------------------------------
| Administración: Acceso exclusivo para Administrador
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {

    // Gestión de usuarios (rol y permisos)
    Route::get('users', [UserRoleController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [UserRoleController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserRoleController::class, 'update'])->name('users.update');

    // Exportación de usuarios
    Route::get('users/export/{format?}', [UserExportController::class, 'export'])->name('users.export');

    // Visualización de políticas
    Route::get('politicas/vistas', [PolicyViewController::class, 'index'])->name('policy_views.index');

    // Auditoría
    Route::get('auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');

    // Inventario de activos
    Route::resource('inventario', AssetController::class)->names('inventario')->parameters(['inventario' => 'asset']);
    Route::get('inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
    Route::delete('inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
    Route::get('inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
    Route::patch('inventario/{id}/restaurar', [AssetController::class, 'restore'])->name('inventario.restore');

    // Documentos asociados a activos
    Route::post('inventario/{asset}/documentos', [DocumentController::class, 'store'])->name('documentos.store');

    // Usuarios
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('index');
        Route::get('crear', [UsuarioController::class, 'create'])->name('create');
        Route::post('/', [UsuarioController::class, 'store'])->name('store');
        Route::get('importar', [UsuarioController::class, 'import'])->name('import');
        Route::post('importar', [UsuarioController::class, 'handleImport'])->name('handleImport');
    });

    Route::get('sedes/{branch}/ubicaciones', [UbicacionesController::class, 'porSede'])
    ->name('sedes.ubicaciones');
});

/*
|--------------------------------------------------------------------------
| Rutas de autenticación Laravel Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
