<div class="grid gap-8 md:grid-cols-2">
    <x-card title="Entrada de Activos">
        <p>Registrar el ingreso físico de activos al centro.</p>
        <x-link-button href="{{ route('porteria.checkin') }}">Registrar entrada</x-link-button>
    </x-card>

    <x-card title="Salida de Activos">
        <p>Registrar la salida física de activos del centro.</p>
        <x-link-button href="{{ route('porteria.checkout') }}">Registrar salida</x-link-button>
    </x-card>
</div>
