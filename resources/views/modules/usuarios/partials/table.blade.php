<x-profile.section-card>
    <div class="overflow-x-auto card-glass">
        <table class="min-w-full text-sm text-left text-gray-800 print:text-xs" id="users-table">
            <thead class="text-xs font-semibold text-gray-600 uppercase border-b bg-sena-gris print:bg-white">
                <tr>
                    <th class="px-4 py-3 no-print">
                        <input type="checkbox" id="select-all" class="form-checkbox" aria-label="Seleccionar todos los usuarios" />
                    </th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Correo</th>
                    <th class="px-4 py-3">Rol</th>
                    <th class="px-4 py-3">Estado</th> {{-- ✅ Nueva columna --}}
                    <th class="px-4 py-3 text-center no-print" colspan="2">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 print:divide-gray-300">
                @forelse($users as $user)
                    <tr class="group hover:bg-gray-50 focus-within:bg-gray-50 print:bg-transparent" data-user-id="{{ $user->id }}">
                        <td class="px-4 py-3 no-print">
                            <input type="checkbox" class="select-user form-checkbox" value="{{ $user->id }}"
                                aria-label="Seleccionar al usuario {{ $user->full_name }}">
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $user->full_name }}
                            <button type="button"
                                class="ml-2 text-xs text-sena-azul hover:underline toggle-details no-print"
                                data-user="{{ $user->id }}"
                                aria-expanded="false"
                                aria-controls="details-{{ $user->id }}">
                                Ver más
                            </button>
                        </td>

                        <td class="px-4 py-3">{{ $user->email }}</td>

                        <td class="px-4 py-3">
                            <x-profile.roles-badge-list :roles="$user->roles" />
                        </td>

                        <td class="px-4 py-3">
                            @if ($user->status === 'activo')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md">
                                    Activo
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-md">
                                    Inactivo
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center no-print">
                            <a href="{{ route('admin.usuarios.show', $user) }}"
                                class="inline-flex items-center gap-1 text-sm font-medium text-blue-700 hover:underline focus:outline-none focus-visible:ring focus-visible:ring-blue-500"
                                aria-label="Ver detalles del usuario {{ $user->full_name }}">
                                <x-heroicon-o-eye class="w-4 h-4" />
                                Ver
                            </a>
                        </td>

                        <td class="px-4 py-3 text-center no-print">
                            <a href="{{ route('admin.usuarios.edit', $user) }}"
                                class="inline-flex items-center gap-1 text-sm font-semibold text-sena-verde hover:underline focus:outline-none focus-visible:ring focus-visible:ring-sena-verde-700"
                                aria-label="Editar usuario {{ $user->full_name }}">
                                <x-heroicon-o-pencil class="w-4 h-4" />
                                Editar
                            </a>
                        </td>
                    </tr>

                    {{-- Fila de detalles (visible con “Ver más” o en impresión) --}}
                    <tr id="details-{{ $user->id }}" class="hidden text-sm text-gray-700 bg-white/80 print:table-row">
                        <td class="no-print"></td>
                        <td colspan="6" class="px-4 py-4">
                            <strong>Permisos asignados:</strong>
                            @if ($user->permissions->isEmpty())
                                <p class="mt-1 italic text-gray-500">Sin permisos asignados directamente</p>
                            @else
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach ($user->permissions as $permission)
                                        <span class="inline-block px-2 py-1 text-xs text-gray-800 rounded-md bg-sena-gris">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            No hay usuarios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="mt-6">{{ $users->links() }}</div>
    </div>
</x-profile.section-card>
