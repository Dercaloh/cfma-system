@extends('layouts.app')

@section('title', 'Auditoría de Vistas de Política de Datos')

@section('content')
    <x-profile.profile-title
        icon="shield"
        title="Registro de Visualizaciones de la Política"
        subtitle="Auditoría de accesos al Acuerdo de Tratamiento de Datos Personales"
    />

    <x-profile.section-card>
        <div class="overflow-x-auto border border-gray-200 rounded-md shadow">
            <table class="min-w-full text-sm text-left text-gray-700 table-auto">
                <thead class="text-xs text-white uppercase bg-sena-verde">
                    <tr>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">IP</th>
                        <th class="px-4 py-2">Usuario</th>
                        <th class="px-4 py-2">Versión</th>
                        <th class="px-4 py-2">Navegador</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($registros as $registro)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ $registro->viewed_at->locale('es_CO')->isoFormat('DD/MM/YYYY hh:mm A') }}
                            </td>
                            <td class="px-4 py-2">{{ $registro->ip_address }}</td>
                            <td class="px-4 py-2">
                                @if($registro->user)
                                    {{ $registro->user->full_name }} <br>
                                    <span class="text-xs text-gray-500">{{ $registro->user->email }}</span>
                                @else
                                    <span class="italic text-gray-400">No autenticado</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $registro->policy_version }}</td>
                            <td class="max-w-xs px-4 py-2 truncate" title="{{ $registro->user_agent }}">
                                {{ Str::limit($registro->user_agent, 50) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">No hay registros aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if($registros->hasPages())
            <div class="mt-6">
                {{ $registros->links() }}
            </div>
        @endif
    </x-profile.section-card>
@endsection
