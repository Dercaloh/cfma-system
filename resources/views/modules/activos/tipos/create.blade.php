<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-12 h-12 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Crear Tipo de Activo</h1>
                <p class="text-sm text-gray-600">Registrar un nuevo tipo de activo en el sistema</p>
            </div>
        </div>
        @can('gestionar tipos de activos')
            <a href="{{ route('admin.tipos_activos.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 action-button">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
                Volver al listado
            </a>
        @endcan
    </div>
</x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Información contextual -->
                    <div class="mb-6">
                        <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">
                                        Información Importante
                                    </h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>Los tipos de activos permiten categorizar y organizar los elementos del inventario institucional. Una vez creado, el tipo estará disponible para la creación de activos.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de creación -->
                    <form method="POST" action="{{ route('admin.tipos_activos.store') }}" class="space-y-6" novalidate>
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <!-- Campo Nombre -->
                            <div class="md:col-span-2">
                                <x-fields.input-field
                                    name="name"
                                    label="Nombre del Tipo de Activo"
                                    type="text"
                                    :value="old('name')"
                                    placeholder="Ej: Computadoras, Mobiliario, Software"
                                    required="true"
                                    maxlength="50"
                                    help="Nombre único que identifica este tipo de activo (máximo 50 caracteres)"
                                />
                            </div>

                            <!-- Campo Descripción -->
                            <div class="md:col-span-2">
                                <x-input-label for="description" value="Descripción (Opcional)" />
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="3"
                                    maxlength="500"
                                    placeholder="Descripción detallada del tipo de activo..."
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="description-help"
                                >{{ old('description') }}</textarea>
                                <p id="description-help" class="mt-2 text-sm text-gray-500">
                                    Información adicional sobre este tipo de activo (máximo 500 caracteres)
                                </p>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Campo Estado -->
                            <div class="md:col-span-2">
                                <x-fields.checkbox-field
                                    name="active"
                                    label="Activo"
                                    :checked="old('active', true)"
                                    help="Determina si este tipo de activo estará disponible para uso"
                                />
                            </div>

                        </div>

                        <!-- Sección de información legal -->
                        <div class="pt-6 border-t">
                            <x-legal.legal-notice
                                title="Tratamiento de Datos"
                                message="La información ingresada será tratada conforme a la Ley 1581/2012 y la Ley 1712/2014. Los datos son de carácter institucional y público."
                            />
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t">
                            <x-link-button
                                href="{{ route('admin.tipos_activos.index') }}"
                                variant="secondary"
                                class="text-gray-800 bg-gray-200 hover:bg-gray-300"
                            >
                                Cancelar
                            </x-link-button>

                            <x-buttons.primary-button type="submit">
                                <x-icons.plus class="w-4 h-4 mr-2" />
                                Crear Tipo de Activo
                            </x-buttons.primary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Script para validaciones del lado del cliente -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const nameInput = document.querySelector('input[name="name"]');
            const descriptionTextarea = document.querySelector('textarea[name="description"]');

            // Validación en tiempo real del nombre
            if (nameInput) {
                nameInput.addEventListener('input', function() {
                    const value = this.value.trim();
                    const isValid = value.length >= 2 && value.length <= 50;

                    if (!isValid && value.length > 0) {
                        this.setCustomValidity('El nombre debe tener entre 2 y 50 caracteres');
                    } else {
                        this.setCustomValidity('');
                    }
                });
            }

            // Contador de caracteres para descripción
            if (descriptionTextarea) {
                const maxLength = 500;
                const helpText = document.querySelector('#description-help');

                descriptionTextarea.addEventListener('input', function() {
                    const currentLength = this.value.length;
                    const remaining = maxLength - currentLength;

                    if (helpText) {
                        helpText.textContent = `${remaining} caracteres restantes`;
                        helpText.className = remaining < 50 ? 'mt-2 text-sm text-orange-600' : 'mt-2 text-sm text-gray-500';
                    }
                });
            }

            // Validación al enviar el formulario
            form.addEventListener('submit', function(e) {
                const name = nameInput.value.trim();

                if (name.length < 2 || name.length > 50) {
                    e.preventDefault();
                    nameInput.focus();
                    nameInput.setCustomValidity('El nombre debe tener entre 2 y 50 caracteres');
                    nameInput.reportValidity();
                    return false;
                }

                // Limpiar espacios en blanco antes del envío
                nameInput.value = name;
                if (descriptionTextarea) {
                    descriptionTextarea.value = descriptionTextarea.value.trim();
                }
            });
        });
    </script>

</x-app-layout>
