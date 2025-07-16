<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-sena-azul drop-shadow-sm">
            Préstamos — Gestión de Activos TI
        </h2>
    </x-slot>

    {{-- Alertas --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 shadow-sm">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Filtros y acciones --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <form method="GET" class="flex items-center gap-2 bg-white p-3 rounded-lg shadow-sm">
            <label for="estado" class="text-sm font-medium text-sena-azul">Estado:</label>
            <select name="estado" id="estado" class="border border-gray-300 rounded px-2 py-1 text-sm">
                <option value="" {{ request('estado') == '' ? 'selected' : '' }}>Todos</option>
                <option value="solicitado" {{ request('estado') == 'solicitado' ? 'selected' : '' }}>Solicitado</option>
                <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                <option value="devuelto" {{ request('estado') == 'devuelto' ? 'selected' : '' }}>Devuelto</option>
            </select>
            <button type="submit" class="btn-sena text-sm">Filtrar</button>
        </form>

        <a href="{{ route('prestamos.solicitar') }}"
           class="btn-sena bg-green-600 hover:bg-green-700 text-white shadow-md">
            + Nueva solicitud
        </a>
    </div>

    {{-- Tabla responsive con Glassmorphism --}}
    <div class="overflow-x-auto bg-white/70 backdrop-blur-md rounded-xl shadow-lg ring-1 ring-sena-verde">
        <table class="w-full table-auto border-collapse text-sm">
            <thead class="bg-sena-gris">
                <tr>
                    <th class="px-4 py-3 text-left">Activo</th>
                    <th class="px-4 py-3 text-left">Solicitado por</th>
                    <th class="px-4 py-3 text-left">Estado</th>
                    <th class="px-4 py-3 text-left">Fecha solicitud</th>
                    <th class="px-4 py-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                    <tr class="border-b hover:bg-sena-gris/70 transition">
                        <td class="px-4 py-2">{{ $loan->asset->name }}</td>
                        <td class="px-4 py-2">{{ $loan->user->name }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 rounded bg-gray-200 text-gray-800 text-xs uppercase tracking-wide">
                                {{ $loan->status->name }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $loan->requested_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 flex flex-wrap gap-2">
                            <a href="{{ route('prestamos.show', $loan) }}"
                               class="text-blue-600 hover:underline text-sm" aria-label="Ver detalles del préstamo">
                                Ver
                            </a>

                            @can('approve', $loan)
                                <form action="{{ route('prestamos.aprobar', $loan) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="text-green-700 hover:underline text-sm"
                                            aria-label="Aprobar solicitud">
                                        Aprobar
                                    </button>
                                </form>
                            @endcan

                            @can('deliver', $loan)
                                <form action="{{ route('prestamos.entregar', $loan) }}" method="POST" enctype="multipart/form-data" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="text-yellow-600 hover:underline text-sm"
                                            aria-label="Registrar entrega">
                                        Entregar
                                    </button>
                                </form>
                            @endcan

                            @can('returnAsset', $loan)
                                <form action="{{ route('prestamos.devolver', $loan) }}" method="POST" enctype="multipart/form-data" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="text-red-600 hover:underline text-sm"
                                            aria-label="Registrar devolución">
                                        Devolver
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500 text-sm">
                            No se encontraron préstamos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $loans->links() }}
    </div>
</x-app-layout>
