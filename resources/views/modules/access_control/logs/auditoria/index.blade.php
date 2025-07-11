<x-app-layout>
    <x-slot name="header">
        <x-layout.context-header>
            <h2 class="text-2xl font-bold text-sena-verde">Bitácora de Auditoría del Sistema</h2>
            <p class="mt-1 text-sm text-gray-700">
                Visualiza la trazabilidad de actividades realizadas por los usuarios autenticados en el sistema.
            </p>
        </x-layout.context-header>
    </x-slot>

    {{-- Filtros --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.auditoria.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-3" aria-label="Filtrar registros de auditoría">
            <div>
                <label for="user_id" class="form-label">Usuario</label>
                <select id="user_id" name="user_id" class="form-input">
                    <option value="">Todos</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" @selected(request('user_id') == $usuario->id)>
                            {{ $usuario->full_name ?? $usuario->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="fecha_inicio" class="form-label">Desde</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="form-input">
            </div>
            <div>
                <label for="fecha_fin" class="form-label">Hasta</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin') }}" class="form-input">
            </div>
            <div class="flex justify-end mt-2 md:col-span-3">
                <x-primary-button>
                    Filtrar
                </x-primary-button>
            </div>
        </form>
    </div>

    {{-- Tabla de auditoría --}}
    <div class="overflow-x-auto card-glass" role="region" aria-label="Registros de auditoría del sistema">
        <table class="min-w-full text-sm divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col" class="px-4 py-3 text-xs font-semibold text-left text-white uppercase bg-sena-verde">Fecha</th>
                    <th scope="col" class="px-4 py-3 text-xs font-semibold text-left text-white uppercase bg-sena-verde">Usuario</th>
                    <th scope="col" class="px-4 py-3 text-xs font-semibold text-left text-white uppercase bg-sena-verde">Acción</th>
                    <th scope="col" class="px-4 py-3 text-xs font-semibold text-left text-white uppercase bg-sena-verde">IP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white/80">
                @forelse($logs as $log)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $log->created_at->locale('es_CO')->isoFormat('DD/MM/YYYY hh:mm A') }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $log->causer?->full_name ?? $log->causer?->name ?? 'Sistema' }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $log->description }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $log->properties['ip'] ?? 'N/D' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-600">
                            No se encontraron registros de auditoría con los filtros aplicados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $logs->appends(request()->query())->links('vendor.pagination.accessible-tailwind') }}
    </div>
</x-app-layout>
