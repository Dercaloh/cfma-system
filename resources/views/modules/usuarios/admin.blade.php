<x-app-layout>
    <x-slot name="title">Panel de Administración</x-slot>

    <x-slot name="header">
        <x-layout.context-header>
            <h2 class="text-2xl font-bold text-sena-verde">Panel de Administración</h2>
            <p class="mt-1 text-sm text-gray-700">
                Accede a los módulos de gestión de usuarios, inventario y cumplimiento normativo.
            </p>
        </x-layout.context-header>
    </x-slot>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">

        <x-dashboard.card
            icon="heroicon-o-users"
            title="Gestión de Usuarios"
            description="Accede al listado de usuarios registrados, realiza registros individuales o carga masiva."
            route="admin.usuarios.index"
            label="Ir al módulo de usuarios"
            can="ver usuarios"
        />

        <x-dashboard.card
            icon="heroicon-o-users"
            title="Usuarios y Roles"
            description="Gestiona los usuarios, roles y permisos del sistema."
            route="admin.users.index"
            label="Gestionar usuarios"
            can="ver roles"
        />

        <x-dashboard.card
            icon="heroicon-o-cube"
            title="Inventario"
            description="Administra los activos tecnológicos del centro."
            route="admin.inventario.index"
            label="Ver inventario"
            can="ver activos"
        />

        <x-dashboard.card
            icon="heroicon-o-shield-check"
            title="Políticas"
            description="Trazabilidad de aceptación del acuerdo de tratamiento de datos personales."
            route="admin.policy_views.index"
            label="Ver auditoría"
            can="ver politicas"
        />

        <x-dashboard.card
            icon="heroicon-o-clipboard-document-list"
            title="Auditoría del Sistema"
            description="Consulta las acciones registradas por los usuarios del sistema en tiempo real."
            route="admin.auditoria.index"
            label="Ver bitácora"
            can="ver auditoria"
        />

    </div>
</x-app-layout>
