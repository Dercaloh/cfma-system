<div class="grid gap-8 md:grid-cols-2">
    <x-card title="Gestión de Activos">
        <p>Visualiza, registra y edita activos del inventario institucional.</p>
        <x-link-button href="{{ route('inventario.index') }}">Gestionar activos</x-link-button>
    </x-card>

    <x-card title="Aprobación de Préstamos">
        <p>Aprueba la salida de activos asignados a tus áreas de formación.</p>
        <x-link-button href="{{ route('prestamos.aprobar') }}">Revisar solicitudes</x-link-button>
    </x-card>

    <x-card title="Auditoría de Entregas">
        <p>Consulta reportes sobre préstamos, devoluciones y responsables.</p>
        <x-link-button href="#">Ver auditoría</x-link-button>
    </x-card>
</div>
