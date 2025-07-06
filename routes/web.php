<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    ProfileController,
    AssetController,
    DocumentController,
    LoanController,
    GateController,
    ExitPassController,
    UserPolicyController,
    UserSecurityLogController,
    DashboardController,
    Admin\UserRoleController,
    Admin\PolicyViewController,
    Admin\UserExportController,
    Admin\AuditoriaController,
    Usuarios\UsuarioController,
};




Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

    Route::get('usuarios/importar', [UsuarioController::class, 'import'])->name('usuarios.import');
    Route::post('usuarios/importar', [UsuarioController::class, 'handleImport'])->name('usuarios.handleImport');
});

/*
|--------------------------------------------------------------------------
| Ruta pública principal
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => Auth::check() ? redirect()->route('dashboard') : view('welcome'))->name('home');

// 🔓 Política pública de protección de datos
Route::get('/politicas/aceptar', [UserPolicyController::class, 'show'])->name('politicas.show');

/*
|--------------------------------------------------------------------------
| Aceptación de políticas (solo autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->post('/politicas/aceptar', [UserPolicyController::class, 'store'])->name('politicas.store');

/*
|--------------------------------------------------------------------------
| Panel principal dinámico (Dashboard unificado por rol)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Panel administrativo y funcionalidades exclusivas del rol Administrador
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    // Gestión de usuarios y roles
    Route::get('users', [UserRoleController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [UserRoleController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserRoleController::class, 'update'])->name('users.update');

    // Exportación de usuarios
    Route::get('users/export/{format?}', [UserExportController::class, 'export'])->name('users.export');

    // Visualización de políticas
    Route::get('politicas/vistas', [PolicyViewController::class, 'index'])->name('policy_views.index');

    // Inventario de activos
    Route::resource('inventario', AssetController::class)
        ->names('inventario')
        ->parameters(['inventario' => 'asset']);

    Route::get('inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
    Route::delete('inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
    Route::get('inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
    Route::patch('inventario/{id}/restaurar', [AssetController::class, 'restore'])->name('inventario.restore');

    // Auditoría de acciones
    Route::get('auditoria', [AuditoriaController::class, 'index'])
        ->name('auditoria.index');


    Route::post('inventario/{asset}/documentos', [DocumentController::class, 'store'])->name('documentos.store');
});

/*
|--------------------------------------------------------------------------
| Perfil de usuario y configuración de seguridad
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Registro de actividad y consentimiento
    Route::post('/seguridad/log', [UserSecurityLogController::class, 'store'])->name('seguridad.log.store');
});

/*
|--------------------------------------------------------------------------
| Solicitud de préstamos (roles específicos)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Aprendiz,Funcionario,Instructor,Vocero Principal,Vocero Suplente'])->group(function () {
    Route::get('/prestamos/solicitar', [LoanController::class, 'create'])->name('prestamos.solicitar');
});

/*
|--------------------------------------------------------------------------
| Gestión de préstamos (autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('prestamos', LoanController::class)->names('prestamos');
    Route::get('prestamos/{loan}/debug', [LoanController::class, 'show'])->name('prestamos.debug');
    Route::post('prestamos/{loan}/aprobar', [LoanController::class, 'approve'])->name('prestamos.aprobar');
    Route::post('prestamos/{loan}/entregar', [LoanController::class, 'checkOut'])->name('prestamos.entregar');
    Route::post('prestamos/{loan}/devolver', [LoanController::class, 'checkIn'])->name('prestamos.devolver');
});

/*
|--------------------------------------------------------------------------
| Portería (acceso controlado)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Portería'])->group(function () {
    Route::view('/porteria/dashboard', 'porteria.dashboard')->name('porteria.dashboard');
    Route::view('/porteria/checkin', 'prestamos.checkin')->name('porteria.checkin');
    Route::view('/porteria/checkout', 'prestamos.checkout')->name('porteria.checkout');
    Route::post('/porteria/{asset}/registro', [GateController::class, 'log'])->name('porteria.registro');
});

/*
|--------------------------------------------------------------------------
| Actas y pases de salida
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/actas/{exitPass}', [ExitPassController::class, 'show'])->name('exit_passes.show');
    Route::get('/actas/{exitPass}/pdf', [ExitPassController::class, 'generatePDF'])->name('exit_passes.pdf');
});

/*
|--------------------------------------------------------------------------
| Laravel Breeze Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
