{{--
    Vista de detalle para tipos de activos - SGPTI SENA
    Cumple normativa: Ley 1712/2014, Resolución 1122/2023, Resolución 1519/2020
    Arquitectura: Laravel 12, Blade, Tailwind CSS, accesibilidad WCAG 2.1
--}}

<x-app-layout>
    <x-slot name="header">
    <x-layout.section-header
        icon="document"
        iconColor="blue"
        title="Detalle del Tipo de Activo"
        subtitle="Información completa y estadísticas del tipo: <strong>{{ $assetType->name }}</strong>">

        <x-slot name="actions">
            <x-buttons.link-button href="{{ route('admin.tipos_activos.edit', $assetType) }}" icon="pencil-square" text="Editar" />
            <x-buttons.link-button href="{{ route('admin.tipos_activos.index') }}" icon="arrow-left" text="Volver al listado" />
        </x-slot>
    </x-layout.section-header>
</x-slot>




    <div class="py-6 space-y-6">
        {{-- Información principal del tipo de activo --}}
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-cards.card-glass>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $assetType->name }}
                                </h1>
                                <div class="flex items-center mt-1 space-x-2">
                                    <x-ui.status-badge :active="$assetType->active" />
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        ID: {{ $assetType->id }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="flex items-center space-x-3">
                            @can('gestionar tipos de activos')
                                <a href="{{ route('admin.tipos_activos.edit', $assetType) }}"
                                    class="inline-flex items-center px-4 py-2 font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <x-icons.edit class="w-4 h-4 mr-2" />
                                    Editar
                                </a>
                            @endcan

                            <a href="{{ route('admin.tipos_activos.index') }}"
                                class="inline-flex items-center px-4 py-2 font-medium text-white transition-colors duration-200 bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Volver al listado
                            </a>
                        </div>
                    </div>

                    {{-- Información detallada --}}
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nombre del Tipo
                                </label>
                                <p
                                    class="px-3 py-2 text-base text-gray-900 rounded-lg dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $assetType->name }}
                                </p>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Estado
                                </label>
                                <div class="flex items-center space-x-2">
                                    <x-ui.status-badge :active="$assetType->active" />
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $assetType->active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Descripción
                                </label>
                                <p
                                    class="text-base text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 rounded-lg px-3 py-2 min-h-[2.5rem]">
                                    {{ $assetType->description ?: 'Sin descripción' }}
                                </p>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha de Creación
                                </label>
                                <p
                                    class="px-3 py-2 text-base text-gray-900 rounded-lg dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $assetType->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-cards.card-glass>
        </div>

        {{-- Estadísticas de activos asociados --}}
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-cards.card-glass>
                <div class="p-6">
                    <h2 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white">
                        Estadísticas de Activos Asociados
                    </h2>

                    <x-stats.stats-card
    title="Total de Activos"
    :value="$stats['total_assets']"
    description="Activos registrados con este tipo"
    color="blue"
    icon="archive-box"
/>

<x-stats.stats-card
    title="Activos Activos"
    :value="$stats['active_assets']"
    description="Activos en estado activo"
    color="green"
    icon="check-circle"
/>

<x-stats.stats-card
    title="Activos Inactivos"
    :value="$stats['inactive_assets']"
    description="Activos en estado inactivo"
    color="red"
    icon="x-circle"
/>

<x-stats.stats-card
    title="Porcentaje de Uso"
    :value="$stats['total_assets'] > 0
        ? number_format(($stats['active_assets'] / $stats['total_assets']) * 100, 1) . '%'
        : '0%'"
    description="Activos activos vs total"
    :color="$stats['total_assets'] > 0 && $stats['active_assets'] / $stats['total_assets'] >= 0.8
        ? 'green'
        : ($stats['total_assets'] > 0 && $stats['active_assets'] / $stats['total_assets'] >= 0.5
            ? 'yellow'
            : 'red')"
    icon="chart-bar"
/>

                </div>
            </x-cards.card-glass>
        </div>

        {{-- Información de auditoría --}}
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-cards.card-glass>
                <div class="p-6">
                    <h2 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white">
                        Información de Auditoría
                    </h2>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Creado por
                                </label>
                                <p
                                    class="px-3 py-2 text-sm text-gray-900 rounded-lg dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $assetType->creator?->name ?? 'Sistema' }}
                                </p>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha de Creación
                                </label>
                                <p
                                    class="px-3 py-2 text-sm text-gray-900 rounded-lg dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $assetType->created_at->format('d/m/Y H:i:s') }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Última modificación por
                                </label>
                                <p
                                    class="px-3 py-2 text-sm text-gray-900 rounded-lg dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $assetType->updater?->name ?? 'Sin modificaciones' }}
                                </p>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha de Última Modificación
                                </label>
                                <p
                                    class="px-3 py-2 text-sm text-gray-900 rounded-lg dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $assetType->updated_at->format('d/m/Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-cards.card-glass>
        </div>

        {{-- Aviso de eliminación si aplica --}}
        @if ($stats['total_assets'] == 0)
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="p-4 border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-800 dark:text-yellow-200">
                                Este tipo de activo no tiene activos asociados y puede ser eliminado si es necesario.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Marca de agua de seguridad --}}
    <x-security.watermark />
</x-app-layout>
