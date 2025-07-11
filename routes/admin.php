<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\UserExportController;
use App\Http\Controllers\Web\Policy\PolicyViewController;
use App\Http\Controllers\Admin\AuditoriaController;
use App\Http\Controllers\Inventory\AssetController;
use App\Http\Controllers\Documents\DocumentController;
use App\Http\Controllers\Users\UsuarioController;
use App\Http\Controllers\Web\UbicacionesController;

Route::middleware(['auth', 'role:Administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 🧭 Panel de Administración
        Route::get('dashboard', fn() => view('dashboard.admin'))->name('dashboard');

        // 👥 Gestión de Usuarios y Roles (Módulo: access_control/roles y users)
        Route::resource('users', UserRoleController::class)->except(['create', 'store', 'destroy']);
        Route::get('users/export/{format?}', [UserExportController::class, 'export'])->name('users.export');

        // 👤 Gestión de Usuarios Registrados (Módulo: modules/usuarios)
        Route::prefix('usuarios')->name('usuarios.')->group(function () {
            Route::get('/', [UsuarioController::class, 'index'])->name('index'); // modules/usuarios/index.blade.php
            Route::get('crear', [UsuarioController::class, 'create'])->name('create'); // modules/usuarios/create.blade.php
            Route::post('/', [UsuarioController::class, 'store'])->name('store');
            Route::get('importar', [UsuarioController::class, 'import'])->name('import'); // modules/usuarios/import.blade.php
            Route::post('importar', [UsuarioController::class, 'handleImport'])->name('handleImport');
        });

        // 📄 Políticas y consentimiento (Módulo: access_control/logs/policy_views)
        Route::get('politicas/vistas', [PolicyViewController::class, 'index'])->name('policy_views.index');

        // 📝 Auditoría del sistema (Módulo: access_control/logs/auditoria)
        Route::get('auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');

        // 💻 Gestión de Inventario (Módulo: modules/inventario)
        Route::resource('inventario', AssetController::class)
            ->names('inventario')
            ->parameters(['inventario' => 'asset']);

        // Eliminación y restauración de activos
        Route::get('inventario/{asset}/eliminar', [AssetController::class, 'destroy'])->name('inventario.confirmDelete');
        Route::delete('inventario/{asset}/eliminar', [AssetController::class, 'deleteConfirm'])->name('inventario.deleteConfirm');
        Route::get('inventario/{id}/restaurar-confirmacion', [AssetController::class, 'confirmRestore'])->name('inventario.confirmRestore');
        Route::patch('inventario/{id}/restaurar', [AssetController::class, 'restore'])->name('inventario.restore');

        // 📎 Documentos adjuntos a activos
        Route::post('inventario/{asset}/documentos', [DocumentController::class, 'store'])->name('documentos.store');

        // 🏢 Carga dinámica de ubicaciones internas por sede (usado en usuario.create)
        Route::get('sedes/{branch}/ubicaciones', [UbicacionesController::class, 'porSede'])->name('sedes.ubicaciones');
    });
