{{-- resources/views/dashboard/partials/funcionario.blade.php --}}
<div class="space-y-4">
    <x-card title="Préstamos Activos">
        <p>Consulta o realiza seguimiento a tus préstamos actuales.</p>
        <x-link-button href="{{ route('prestamos.index') }}">Ver préstamos</x-link-button>
    </x-card>

    <x-card title="Solicitar Nuevo Préstamo">
        <p>Realiza una nueva solicitud de préstamo de activo institucional.</p>
        <x-link-button href="{{ route('prestamos.solicitar') }}">Solicitar</x-link-button>
    </x-card>
</div>
