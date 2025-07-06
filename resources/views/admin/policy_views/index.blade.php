{{-- resources/views/admin/policy_views/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-sena-azul">Vistas de Políticas de Privacidad</h2>
    </x-slot>

    <div class="p-6 bg-white shadow-sm rounded-xl">
        <table class="w-full text-sm border border-gray-300 table-auto">
            <thead class="text-white bg-sena-verde">
                <tr>
                    <th class="px-4 py-2">Usuario</th>
                    <th class="px-4 py-2">Versión</th>
                    <th class="px-4 py-2">Fecha de Visualización</th>
                    <th class="px-4 py-2">IP</th>
                    <th class="px-4 py-2">Navegador</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registros as $registro)
                    <tr class="border-t border-gray-300 bg-white/80">
                        <td class="px-4 py-2">{{ $registro->user->full_name ?? 'Anónimo' }}</td>
                        <td class="px-4 py-2">{{ $registro->policy_version }}</td>
                        <td class="px-4 py-2">{{ $registro->viewed_at->format('Y-m-d H:i:s') }}</td>
                        <td class="px-4 py-2">{{ $registro->ip_address }}</td>
                        <td class="px-4 py-2">{{ $registro->user_agent }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-2 text-center text-gray-500">Sin registros</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $registros->links() }}
        </div>
    </div>
</x-app-layout>
