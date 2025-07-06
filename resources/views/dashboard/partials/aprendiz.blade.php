<div class="space-y-4">
    <x-card title="Mi Perfil">
        <p>Consulta y actualiza tu información personal registrada en el sistema.</p>
        <x-link-button href="{{ route('profile.edit') }}">Editar perfil</x-link-button>
    </x-card>

    <x-card title="Carné Digital (Próximamente)">
        <p>Funcionalidad futura para generar un carné institucional con QR de autenticación.</p>
        <x-link-button href="#" disabled>Solicitar carné</x-link-button>
    </x-card>
</div>
