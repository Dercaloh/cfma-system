<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsuarioController;
use App\Http\Controllers\Admin\UserExportController;
use App\Http\Controllers\Web\Policy\PolicyViewController;
use App\Http\Controllers\Admin\AuditoriaController;
use App\Http\Controllers\Assets\AssetController;
use App\Http\Controllers\Documents\DocumentController;
use App\Http\Controllers\Web\UbicacionesController;
use App\Http\Controllers\Users\UsuarioImportController;
use App\Http\Controllers\Assets\AssetTypeController;

// En routes/web.php

Route::middleware(['auth', 'role:Administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 🧭 Panel de Administración
        Route::view('dashboard', 'dashboard.admin')->name('dashboard');

        // 👤 Gestión integral de usuarios
        Route::prefix('usuarios')->name('usuarios.')->group(function () {

            // CRUD de usuarios
            Route::controller(UsuarioController::class)->group(function () {
                Route::get('/', 'index')->name('index');                // Listado
                Route::get('crear', 'create')->name('create');          // Formulario
                Route::post('/', 'store')->name('store');               // Guardar nuevo
                Route::get('{user}/editar', 'edit')->name('edit');      // Editar usuario
                Route::put('{user}', 'update')->name('update');         // Actualizar usuario
                Route::get('{user}', 'show')->name('show');             // Ver detalle
            });

            // 🧾 Exportación (requiere permiso explícito)
            Route::post('export', [UserExportController::class, 'export'])
                ->name('export')
                ->middleware('can:exportar usuarios');

            // 📥 Importación masiva de usuarios
            Route::middleware('permission:importar usuarios')
                ->prefix('importar')
                ->name('importar.')
                ->group(function () {
                    Route::get('/', [UsuarioImportController::class, 'index'])->name('index');
                    Route::post('/preview', [UsuarioImportController::class, 'preview'])->name('preview');
                    Route::post('/procesar', [UsuarioImportController::class, 'procesar'])->name('procesar');
                    Route::get('/historial', [UsuarioImportController::class, 'history'])->name('history');
                    Route::get('/plantilla', [UsuarioImportController::class, 'downloadTemplate'])->name('plantilla');
                    Route::post('/cancelar', [UsuarioImportController::class, 'cancelar'])->name('cancelar');
                });
        });

        // 📄 Seguimiento de políticas y consentimiento
        Route::get('politicas/vistas', [PolicyViewController::class, 'index'])->name('policy_views.index');

        // 📝 Auditoría del sistema
        Route::get('auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');

        // 💻 Inventario TIC
        Route::resource('inventario', AssetController::class)
            ->names('inventario')
            ->parameters(['inventario' => 'asset']);

        // Acciones adicionales para inventario
        Route::get('inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
        Route::delete('inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
        Route::get('inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
        Route::patch('inventario/{id}/restaurar', [AssetController::class, 'restore'])->name('inventario.restore');

        // 📎 Documentos de activos
        Route::post('inventario/{asset}/documentos', [DocumentController::class, 'store'])->name('documentos.store');

        // 🏢 Consulta dinámica de ubicaciones
        Route::get('sedes/{branch}/ubicaciones', [UbicacionesController::class, 'porSede'])->name('sedes.ubicaciones');



      Route::prefix('tipos-activos')->name('tipos_activos.')->group(function () {

                Route::get('/', [AssetTypeController::class, 'index'])->name('index');
                Route::get('/crear', [AssetTypeController::class, 'create'])->name('create');
                Route::post('/', [AssetTypeController::class, 'store'])->name('store');
                Route::get('/{assetType}', [AssetTypeController::class, 'show'])->name('show');
                Route::get('/{assetType}/editar', [AssetTypeController::class, 'edit'])->name('edit');
                Route::put('/{assetType}', [AssetTypeController::class, 'update'])->name('update');
                Route::delete('/{assetType}', [AssetTypeController::class, 'destroy'])->name('destroy');
            });
    });
