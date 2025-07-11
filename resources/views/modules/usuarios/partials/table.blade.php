 <x-profile.section-card>
     <div class="overflow-x-auto card-glass">
         <table class="min-w-full text-sm text-left text-gray-800" id="users-table">
             <thead class="text-xs font-semibold text-gray-600 uppercase border-b bg-sena-gris">
                 <tr>
                     <th class="px-4 py-3">
                         <input type="checkbox" id="select-all" class="form-checkbox" />
                     </th>
                     <th class="px-4 py-3">Nombre</th>
                     <th class="px-4 py-3">Correo</th>
                     <th class="px-4 py-3">Rol</th>
                     <th class="px-4 py-3 text-center">Acción</th>
                 </tr>
             </thead>
             <tbody class="divide-y divide-gray-200">
                 @forelse($users as $user)
                     <tr class="cursor-pointer hover:bg-gray-50 focus-within:bg-gray-50 group"
                         data-user-id="{{ $user->id }}">
                         <td class="px-4 py-3">
                             <input type="checkbox" class="select-user form-checkbox" value="{{ $user->id }}"
                                 aria-label="Seleccionar {{ $user->full_name }}">
                         </td>
                         <td class="px-4 py-3 font-medium">
                             {{ $user->full_name }}
                             <button type="button" class="ml-2 text-xs text-sena-azul hover:underline toggle-details"
                                 data-user="{{ $user->id }}" aria-expanded="false">
                                 Ver más
                             </button>
                         </td>
                         <td class="px-4 py-3">{{ $user->email }}</td>
                         <td class="px-4 py-3">
                             <x-profile.roles-badge-list :roles="$user->roles" />
                         </td>
                         <td class="px-4 py-3 text-center">
                             <a href="{{ route('admin.users.edit', $user) }}"
                                 class="inline-flex items-center gap-1 text-sm font-semibold rounded-md text-sena-verde hover:underline focus:outline-none focus-visible:ring focus-visible:ring-sena-verde-700"
                                 aria-label="Editar roles del usuario {{ $user->full_name }}">
                                 <x-heroicon-o-pencil class="w-4 h-4" />
                                 Editar
                             </a>
                         </td>
                     </tr>

                     {{-- Fila de detalles ocultos --}}
                     <tr id="details-{{ $user->id }}" class="hidden text-sm text-gray-700 bg-white/80">
                         <td></td>
                         <td colspan="4" class="px-4 py-4">
                             <div class="grid grid-cols-1 gap-4 mb-3 sm:grid-cols-3">
                                 <div><strong>Documento:</strong> {{ $user->employee_id ?? 'No registrado' }}</div>
                                 <div><strong>Área:</strong> {{ $user->department?->name ?? 'Sin asignar' }}</div>
                                 <div><strong>Ubicación:</strong> {{ $user->location?->name ?? 'Sin asignar' }}</div>
                             </div>
                             <div class="mt-3">
                                 <strong>Permisos asignados:</strong>
                                 @if ($user->permissions->isEmpty())
                                     <p class="mt-1 italic text-gray-500">Sin permisos asignados directamente</p>
                                 @else
                                     <div class="flex flex-wrap gap-1 mt-2">
                                         @foreach ($user->permissions as $permission)
                                             <span
                                                 class="inline-block px-2 py-1 text-xs text-gray-800 rounded-md bg-sena-gris">
                                                 {{ $permission->name }}
                                             </span>
                                         @endforeach
                                     </div>
                                 @endif
                             </div>
                         </td>
                     </tr>
                 @empty
                     <tr>
                         <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                             No hay usuarios registrados.
                         </td>
                     </tr>
                 @endforelse
             </tbody>
         </table>

         <div class="mt-6">{{ $users->links() }}</div>
     </div>
 </x-profile.section-card>
