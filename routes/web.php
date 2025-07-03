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
    UserSecurityLogController,
    RegistroController
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
Route::get('/politica-privacidad', function () {
    return view('legal.privacy-policy');
})->name('legal.privacy');


/*
|--------------------------------------------------------------------------
| Redirección dinámica tras login según rol
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function (Request $request) {
    $user = $request->user();
    $role = $user->role?->name;

    return match ($role) {
        'Administrador'       => redirect()->route('admin.dashboard'),
        'Subdirector'         => redirect()->route('subdirector.dashboard'),
        'Coordinador'         => redirect()->route('coordinador.dashboard'),
        'Funcionario'         => redirect()->route('funcionario.dashboard'),
        'Portería'            => redirect()->route('porteria.dashboard'),
        'Aprendiz'            => redirect()->route('aprendiz.dashboard'),
        'Vocero'              => redirect()->route('vocero.dashboard'),
        'Vocero Suplente'     => redirect()->route('vocero.dashboard'),
        default               => abort(403, 'Rol no autorizado.')
    };
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas comunes para todos los autenticados
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/politicas/aceptar', [UserPolicyController::class, 'store'])->name('politicas.store');
    Route::post('/seguridad/log', [UserSecurityLogController::class, 'store'])->name('seguridad.log.store');

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Solicitud de préstamos: Aprendiz, Funcionario, Vocero, Vocero Suplente
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Aprendiz,Funcionario,Vocero,Vocero Suplente'])->group(function () {
    Route::get('/prestamos/solicitar', [LoanController::class, 'create'])->name('prestamos.solicitar');
});

/*
|--------------------------------------------------------------------------
| Gestión de préstamos para todos los roles autenticados
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('/prestamos', LoanController::class)->names('prestamos');
    Route::get('/prestamos/{loan}/debug', [LoanController::class, 'show'])->name('prestamos.debug');
    Route::post('/prestamos/{loan}/aprobar', [LoanController::class, 'approve'])->name('prestamos.aprobar');
    Route::post('/prestamos/{loan}/entregar', [LoanController::class, 'checkOut'])->name('prestamos.entregar');
    Route::post('/prestamos/{loan}/devolver', [LoanController::class, 'checkIn'])->name('prestamos.devolver');
});

/*
|--------------------------------------------------------------------------
| Portería
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
| Panel por Rol (Dashboards)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::resource('/inventario', AssetController::class)->names('inventario')->parameters(['inventario' => 'asset']);
    Route::get('/inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
    Route::delete('/inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
    Route::get('/inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
    Route::patch('/inventario/{id}/restaurar', [AssetController::class, 'restore'])->name('inventario.restore');
    Route::post('/inventario/{asset}/documentos', [DocumentController::class, 'store'])->name('documentos.store');
});

Route::middleware(['auth', 'role:Subdirector'])->group(function () {
    Route::view('/subdirector/dashboard', 'subdirector.dashboard')->name('subdirector.dashboard');
    Route::view('/prestamos/aprobar', 'prestamos.aprobar')->name('prestamos.aprobar');
});

Route::middleware(['auth', 'role:Coordinador'])->group(function () {
    Route::view('/coordinador/dashboard', 'coordinador.dashboard')->name('coordinador.dashboard');
});

Route::middleware(['auth', 'role:Funcionario'])->group(function () {
    Route::view('/funcionario/dashboard', 'funcionario.dashboard')->name('funcionario.dashboard');
});

Route::middleware(['auth', 'role:Aprendiz,Vocero,Vocero Suplente'])->group(function () {
    Route::view('/aprendiz/dashboard', 'aprendiz.dashboard')->name('aprendiz.dashboard');
});

/*
|--------------------------------------------------------------------------
| Actas (Pases de salida)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/actas/{exitPass}', [ExitPassController::class, 'show'])->name('exit_passes.show');
    Route::get('/actas/{exitPass}/pdf', [ExitPassController::class, 'generatePDF'])->name('exit_passes.pdf');
});

/*
|--------------------------------------------------------------------------
| Breeze (Laravel Breeze auth)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
