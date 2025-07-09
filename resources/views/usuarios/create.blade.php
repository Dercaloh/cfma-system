{{-- resources/views/usuarios/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Registrar Usuario</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form method="POST" action="{{ route('admin.usuarios.store') }}" class="p-6 space-y-6 bg-white rounded shadow-md">
            @csrf

            {{-- Pasamos una instancia vacía de User para evitar errores --}}
            @include('usuarios.partials.form', ['user' => new \App\Models\Users\User()])



            <div class="flex items-center justify-start pt-4 space-x-4">
                <x-buttons.primary-button>
                    Registrar Usuario
                </x-buttons.primary-button>

                <a href="{{ route('admin.usuarios.index') }}"
                   class="text-sm text-gray-600 underline hover:text-gray-800 focus-visible:outline focus-visible:ring focus-visible:ring-blue-500">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    {{-- Script para cargar dinámicamente las ubicaciones internas según la sede --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const branchSelect = document.querySelector('select[name="branch_id"]');
                const locationSelect = document.querySelector('select[name="location_id"]');

                if (!branchSelect || !locationSelect) return;

                branchSelect.addEventListener('change', async function () {
                    const branchId = this.value;
                    locationSelect.innerHTML = '<option value="">Cargando...</option>';
                    locationSelect.disabled = true;

                    try {
                        const response = await fetch(`/admin/sedes/${branchId}/ubicaciones`);
                        const data = await response.json();

                        if (data.success) {
                            locationSelect.innerHTML = '<option value="">Seleccione una ubicación interna</option>';
                            data.locations.forEach(loc => {
                                const option = document.createElement('option');
                                option.value = loc.id;
                                option.textContent = `${loc.name} (${loc.code ?? 'Sin código'})`;
                                locationSelect.appendChild(option);
                            });
                        } else {
                            locationSelect.innerHTML = '<option value="">No se encontraron ubicaciones</option>';
                        }
                    } catch (error) {
                        locationSelect.innerHTML = '<option value="">Error al cargar ubicaciones</option>';
                    } finally {
                        locationSelect.disabled = false;
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
