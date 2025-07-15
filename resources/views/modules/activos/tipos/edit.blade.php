<x-app-layout>
    <x-slot name="header">
    <x-layout.section-header
        icon="pencil-square"
        iconColor="amber"
        title="Editar Tipo de Activo"
        subtitle="Modifica la información de: <strong>{{ $assetType->name }}</strong>"
    >
        <x-slot name="actions">
            <x-buttons.link-button
                href="{{ route('admin.tipos_activos.show', $assetType) }}"
                icon="eye"
                text="Ver detalle"
            />
            <x-buttons.link-button
                href="{{ route('admin.tipos_activos.index') }}"
                icon="arrow-left"
                text="Volver al listado"
            />
        </x-slot>
    </x-layout.section-header>
</x-slot>



    {{-- Información del activo --}}
    <x-asset.info :assetType="$assetType" />

    {{-- Alerta si hay activos asociados --}}
    @if ($assetType->assets_count > 0)
        <x-ui.alert type="warning" title="Activos dependientes" icon="exclamation">
            Este tipo de activo tiene <strong>{{ $assetType->assets_count }}</strong> activo(s) asociado(s).
            Si lo desactivas, no aparecerá en formularios de nuevos activos, pero los existentes no se verán afectados.
        </x-ui.alert>
    @endif

    {{-- Formulario --}}
    <x-cards.card-glass class="mt-6">
        <div class="p-6 border-b border-sena-gris/30">
            <h2 class="text-lg font-semibold text-sena-azul">Modificar Información</h2>
            <p class="mt-1 text-sm text-sena-azul/70">Actualiza los campos necesarios y guarda los cambios.</p>
        </div>

        <form action="{{ route('admin.tipos_activos.update', $assetType) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Campo: Nombre --}}
            <x-fields.input-field name="name" label="Nombre del tipo de activo"
                placeholder="Ej: Computadores, Impresoras, Licencias de software..."
                value="{{ old('name', $assetType->name) }}" required icon="archive-box"
                help="Nombre único que identifique el tipo de activo. Evita caracteres especiales." />

            {{-- Campo: Descripción --}}
            <x-fields.textarea-field id="description" name="description" label="Descripción"
                placeholder="Describe brevemente este tipo de activo y sus características principales..."
                :value="old('description', $assetType->description)"
                help="Máximo 500 caracteres. Esta información ayuda a otros usuarios a entender el propósito del tipo de activo."
                rows="3" />
            <div id="char-count" class="text-sm text-sena-azul/60">
                Caracteres restantes: {{ 255 - strlen(old('description', $assetType->description ?? '')) }}
            </div>

            {{-- Campo: Estado --}}
            <x-fields.checkbox-field name="active" label="Tipo de activo activo"
                description="Los tipos activos aparecerán disponibles para asignar a nuevos activos"
                :checked="old('active', $assetType->active)" />

            @if ($assetType->assets_count > 0 && !$assetType->active)
                <x-ui.alert type="warning" icon="exclamation" class="mt-2">
                    Este tipo está inactivo pero tiene activos asociados.
                </x-ui.alert>
            @endif

            {{-- Auditoría --}}
            <x-form.audit-info :createdAt="$assetType->created_at" :updatedAt="$assetType->updated_at" />

            {{-- Botones de acción --}}
            <x-buttons.form-action-buttons cancelHref="{{ route('admin.tipos_activos.index') }}" cancelText="Cancelar"
                submitText="Guardar Cambios" />
        </form>
    </x-cards.card-glass>

    {{-- Información Legal --}}
    <x-legal.section-legal />
</x-app-layout>
