{{-- resources/views/demo/components.blade.php --}}
@extends('layouts.app')

@section('title', 'Demo de Componentes SGPTI')

@section('content')
<div class="min-h-screen p-6 bg-gradient-to-br from-green-50 to-blue-50">
    <div class="mx-auto max-w-7xl">
        {{-- Header --}}
        <div class="mb-8 text-center">
            <h1 class="mb-2 text-4xl font-bold text-gray-800">
                Demo de Componentes SGPTI
            </h1>
            <p class="text-gray-600">
                Demostración de los nuevos componentes Blade con estilos SENA
            </p>
        </div>

        {{-- Tab Navigation Demo --}}
        <div class="mb-12">
            <div class="p-6 border border-green-100 shadow-xl bg-white/80 backdrop-blur-sm rounded-2xl">
                <h2 class="flex items-center mb-4 text-2xl font-semibold text-gray-800">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v1a2 2 0 002 2h4a2 2 0 012 2v8a4 4 0 01-4 4H7z"></path>
                    </svg>
                    Tab Navigation Component
                </h2>

                <x-interaction.tab-navigation
                    :tabs="[
                        ['id' => 'usuarios', 'label' => 'Usuarios', 'icon' => 'users'],
                        ['id' => 'recursos', 'label' => 'Recursos', 'icon' => 'laptop'],
                        ['id' => 'reportes', 'label' => 'Reportes', 'icon' => 'chart-bar'],
                        ['id' => 'configuracion', 'label' => 'Configuración', 'icon' => 'cog']
                    ]"
                    default-tab="usuarios"
                />

                {{-- Tab Content --}}
                <div class="mt-6">
                    <div id="usuarios-content" class="tab-content">
                        <div class="p-4 rounded-lg bg-green-50">
                            <h3 class="mb-2 font-semibold text-green-800">Gestión de Usuarios</h3>
                            <p class="text-green-700">Administra usuarios del sistema SGPTI.</p>
                        </div>
                    </div>
                    <div id="recursos-content" class="hidden tab-content">
                        <div class="p-4 rounded-lg bg-blue-50">
                            <h3 class="mb-2 font-semibold text-blue-800">Recursos Tecnológicos</h3>
                            <p class="text-blue-700">Gestiona equipos y recursos tecnológicos.</p>
                        </div>
                    </div>
                    <div id="reportes-content" class="hidden tab-content">
                        <div class="p-4 rounded-lg bg-purple-50">
                            <h3 class="mb-2 font-semibold text-purple-800">Reportes y Estadísticas</h3>
                            <p class="text-purple-700">Visualiza reportes del sistema.</p>
                        </div>
                    </div>
                    <div id="configuracion-content" class="hidden tab-content">
                        <div class="p-4 rounded-lg bg-gray-50">
                            <h3 class="mb-2 font-semibold text-gray-800">Configuración del Sistema</h3>
                            <p class="text-gray-700">Ajusta configuraciones generales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Photo Capture Demo --}}
        <div class="mb-12">
            <div class="p-6 border border-green-100 shadow-xl bg-white/80 backdrop-blur-sm rounded-2xl">
                <h2 class="flex items-center mb-4 text-2xl font-semibold text-gray-800">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Photo Capture Component
                </h2>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <h3 class="mb-3 font-semibold text-gray-700">Captura de Foto de Perfil</h3>
                        <x-interaction.photo-capture
                            id="profile-photo"
                            label="Foto de Perfil"
                            :required="true"
                            max-file-size="2048"
                            :allowed-types="['image/jpeg', 'image/png']"
                            :show-preview="true"
                            :enable-camera="true"
                            placeholder="Selecciona o captura una foto de perfil"
                        />
                    </div>

                    <div>
                        <h3 class="mb-3 font-semibold text-gray-700">Captura de Documento</h3>
                        <x-interaction.photo-capture
                            id="document-photo"
                            label="Documento de Identidad"
                            :required="false"
                            max-file-size="5120"
                            :allowed-types="['image/jpeg', 'image/png', 'application/pdf']"
                            :show-preview="true"
                            :enable-camera="true"
                            placeholder="Captura o selecciona el documento"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Filters Demo --}}
        <div class="mb-12">
            <div class="p-6 border border-green-100 shadow-xl bg-white/80 backdrop-blur-sm rounded-2xl">
                <h2 class="flex items-center mb-4 text-2xl font-semibold text-gray-800">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                    </svg>
                    Table Filters Component
                </h2>

                <x-data-grid.table-filters
                    :filters="[
                        [
                            'type' => 'text',
                            'name' => 'search',
                            'label' => 'Buscar',
                            'placeholder' => 'Buscar por nombre o email...'
                        ],
                        [
                            'type' => 'select',
                            'name' => 'status',
                            'label' => 'Estado',
                            'options' => [
                                'all' => 'Todos',
                                'active' => 'Activo',
                                'inactive' => 'Inactivo',
                                'pending' => 'Pendiente'
                            ],
                            'default' => 'all'
                        ],
                        [
                            'type' => 'select',
                            'name' => 'role',
                            'label' => 'Rol',
                            'options' => [
                                'all' => 'Todos los roles',
                                'admin' => 'Administrador',
                                'instructor' => 'Instructor',
                                'student' => 'Estudiante',
                                'coordinator' => 'Coordinador'
                            ],
                            'default' => 'all'
                        ],
                        [
                            'type' => 'date',
                            'name' => 'created_from',
                            'label' => 'Fecha desde'
                        ],
                        [
                            'type' => 'date',
                            'name' => 'created_to',
                            'label' => 'Fecha hasta'
                        ]
                    ]"
                    action-url="/demo/users"
                    :collapsible="true"
                    :show-count="true"
                    reset-text="Limpiar Filtros"
                    apply-text="Aplicar Filtros"
                />

                {{-- Demo Table --}}
                <div class="mt-6">
                    <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm">
                        <table class="w-full">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-green-800 uppercase">
                                        Usuario
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-green-800 uppercase">
                                        Rol
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-green-800 uppercase">
                                        Estado
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-green-800 uppercase">
                                        Fecha
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full">
                                                    <span class="font-medium text-green-600">JD</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Juan Pérez
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    juan.perez@sena.edu.co
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                            Instructor
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        2024-01-15
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <div class="flex items-center justify-center w-10 h-10 bg-purple-100 rounded-full">
                                                    <span class="font-medium text-purple-600">MG</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    María García
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    maria.garcia@sena.edu.co
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                            Administrador
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        2024-01-10
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <div class="flex items-center justify-center w-10 h-10 bg-yellow-100 rounded-full">
                                                    <span class="font-medium text-yellow-600">CR</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    Carlos Rodríguez
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    carlos.rodriguez@sena.edu.co
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                            Coordinador
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">
                                            Pendiente
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        2024-01-12
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-8 text-center text-gray-500">
            <p>Demo creado para el Sistema de Gestión de Proyectos Tecnológicos e Innovación - SENA</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation Logic
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.dataset.tab;

            // Update active tab button
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Update active tab content
            tabContents.forEach(content => {
                content.classList.add('hidden');
                if (content.id === targetTab + '-content') {
                    content.classList.remove('hidden');
                }
            });
        });
    });
});
</script>

<style>
/* Estilos adicionales para la demo */
.tab-button.active {
    background-color: #39A900;
    color: white;
}

.tab-button:hover {
    background-color: #2d7a00;
}

/* Glassmorphism effect */
.backdrop-blur-sm {
    backdrop-filter: blur(8px);
}

/* Animations */
.tab-content {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #39A900;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #2d7a00;
}
</style>
@endsection
