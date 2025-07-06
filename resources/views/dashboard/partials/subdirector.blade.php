<div class="grid gap-8 md:grid-cols-2">
    <x-card title="Aprobación General de Préstamos">
        <p>Revisa y aprueba solicitudes de préstamo de activos en todo el centro.</p>
        <x-link-button href="{{ route('prestamos.aprobar') }}">Aprobar solicitudes</x-link-button>
    </x-card>

    <x-card title="Auditoría y Reportes">
        <p>Consulta trazabilidad, accesos y movimientos del sistema.</p>
        <x-link-button href="#">Ver auditoría</x-link-button>
    </x-card>

    <x-card title="Inventario Completo">
        <p>Acceso total a los activos registrados en el centro.</p>
        <x-link-button href="{{ route('inventario.index') }}">Ver inventario</x-link-button>
    </x-card>
</div>
