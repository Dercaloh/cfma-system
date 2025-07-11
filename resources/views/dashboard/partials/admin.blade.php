<?php
/**
 * Panel Principal para Administradores
 * Ubicación: resources/views/admin/dashboard.blade.php
 */
?>

<x-app-layout>
    <x-slot name="header">
        <x-layout.context-header>
            <h2 class="text-2xl font-bold text-sena-verde">Panel de Administración</h2>
            <p class="mt-1 text-sm text-gray-700">Accede a los módulos de gestión de usuarios, inventario y cumplimiento
                normativo.</p>
        </x-layout.context-header>
    </x-slot>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Gestión Integral de Usuarios --}}
        <div class="p-6 transition-shadow duration-200 rounded-2xl bg-white/60 backdrop-blur hover:shadow-lg">
            <div class="flex items-center gap-4 mb-4">
                <x-heroicon-o-users class="w-6 h-6 text-sena-verde" aria-hidden="true" />
                <h3 class="text-lg font-semibold text-gray-800">Gestión Integral de Usuarios</h3>
            </div>
            <p class="text-sm text-gray-600">
                Registra usuarios, realiza carga masiva y gestiona sus roles y permisos.
            </p>
            @if (Route::has('admin.usuarios.index'))
                <a href="{{ route('admin.usuarios.index') }}"
                    class="inline-flex items-center gap-1 mt-4 text-sm font-semibold text-sena-verde hover:underline">
                    Ir al módulo de usuarios
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            @endif
        </div>


        {{-- Inventario --}}
        <div class="p-6 transition-shadow duration-200 rounded-2xl bg-white/60 backdrop-blur hover:shadow-lg">
            <div class="flex items-center gap-4 mb-4">
                <x-heroicon-o-cube class="w-6 h-6 text-sena-verde" aria-hidden="true" />
                <h3 class="text-lg font-semibold text-gray-800">Inventario</h3>
            </div>
            <p class="text-sm text-gray-600">
                Administra los activos tecnológicos del centro.
            </p>
            @if (Route::has('admin.inventario.index'))
                <a href="{{ route('admin.inventario.index') }}"
                    class="inline-flex items-center gap-1 mt-4 text-sm font-semibold text-sena-verde hover:underline">
                    Ver inventario
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            @endif
        </div>

        {{-- Políticas --}}
        <div class="p-6 transition-shadow duration-200 rounded-2xl bg-white/60 backdrop-blur hover:shadow-lg">
            <div class="flex items-center gap-4 mb-4">
                <x-heroicon-o-shield-check class="w-6 h-6 text-sena-verde" aria-hidden="true" />
                <h3 class="text-lg font-semibold text-gray-800">Políticas</h3>
            </div>
            <p class="text-sm text-gray-600">
                Revisa la trazabilidad de aceptación del acuerdo de tratamiento de datos personales.
            </p>
            @if (Route::has('admin.policy_views.index'))
                <a href="{{ route('admin.policy_views.index') }}"
                    class="inline-flex items-center gap-1 mt-4 text-sm font-semibold text-sena-verde hover:underline">
                    Ver auditoría
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            @endif
        </div>

        {{-- Auditoría del Sistema --}}
        <div class="p-6 transition-shadow duration-200 rounded-2xl bg-white/60 backdrop-blur hover:shadow-lg">
            <div class="flex items-center gap-4 mb-4">
                <x-heroicon-o-clipboard-document-list class="w-6 h-6 text-sena-verde" aria-hidden="true" />
                <h3 class="text-lg font-semibold text-gray-800">Auditoría del Sistema</h3>
            </div>
            <p class="text-sm text-gray-600">
                Consulta las acciones registradas por los usuarios del sistema en tiempo real.
            </p>
            @if (Route::has('admin.auditoria.index'))
                <a href="{{ route('admin.auditoria.index') }}"
                    class="inline-flex items-center gap-1 mt-4 text-sm font-semibold text-sena-verde hover:underline">
                    Ver bitácora
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            @endif
        </div>

    </div>



</x-app-layout>
