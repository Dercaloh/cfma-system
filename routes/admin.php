<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsuarioController;
use App\Http\Controllers\Admin\UserExportController;
use App\Http\Controllers\Web\Policy\PolicyViewController;
use App\Http\Controllers\Admin\AuditoriaController;
use App\Http\Controllers\Inventory\AssetController;
use App\Http\Controllers\Documents\DocumentController;
use App\Http\Controllers\Web\UbicacionesController;

Route::middleware(['auth', 'role:Administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 🧭 Panel de Administración
        Route::get('dashboard', fn() => view('dashboard.admin'))->name('dashboard');

        // 👤 Gestión integral de usuarios (roles, permisos, importación)
        Route::prefix('usuarios')->name('usuarios.')->controller(UsuarioController::class)->group(function () {
            Route::get('/', 'index')->name('index'); // Listado
            Route::get('crear', 'create')->name('create'); // Formulario
            Route::post('/', 'store')->name('store'); // Almacenar nuevo
            Route::get('importar', 'import')->name('import'); // Vista de importación
            Route::post('importar', 'handleImport')->name('handleImport'); // Procesamiento
            Route::get('{user}/editar', 'edit')->name('edit'); // Editar usuario
            Route::put('{user}', 'update')->name('update'); // Guardar cambios
            Route::get('{user}', 'show')->name('show');
        });

        // Ruta export fuera del grupo con middleware 'can:exportar usuarios' para evitar 403
        Route::post('usuarios/export', [UserExportController::class, 'export'])
            ->name('usuarios.export')
            ->middleware('can:exportar usuarios');

        // 📄 Seguimiento de políticas y consentimiento
        Route::get('politicas/vistas', [PolicyViewController::class, 'index'])->name('policy_views.index');

        // 📝 Auditoría del sistema
        Route::get('auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');

        // 💻 Inventario TIC
        Route::resource('inventario', AssetController::class)
            ->names('inventario')
            ->parameters(['inventario' => 'asset']);

        Route::get('inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
        Route::delete('inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
        Route::get('inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
        Route::patch('inventario/{id}/restaurar', [AssetController::class, 'restore'])->name('inventario.restore');

        // 📎 Documentos de activos
        Route::post('inventario/{asset}/documentos', [DocumentController::class, 'store'])->name('documentos.store');

        // 🏢 Consulta dinámica de ubicaciones
        Route::get('sedes/{branch}/ubicaciones', [UbicacionesController::class, 'porSede'])->name('sedes.ubicaciones');
    });
