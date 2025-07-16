<div class="grid grid-cols-1 gap-6 text-sm text-gray-800 sm:grid-cols-2">
    <div>
        <strong>Nombre completo:</strong>
        <p>{{ $user->full_name }}</p>
    </div>
    <div>
        <strong>Correo electrónico:</strong>
        <p>{{ $user->email }}</p>
    </div>
    <div>
        <strong>Tipo de documento:</strong>
        <p>{{ $user->document_type ?? 'No especificado' }}</p>
    </div>
    <div>
        <strong>Número de documento:</strong>
        <p>{{ $user->employee_id ?? 'No registrado' }}</p>
    </div>
    <div>
        <strong>Área / Departamento:</strong>
        <p>{{ $user->department->name ?? 'No asignado' }}</p>
    </div>
    <div>
        <strong>Ubicación física:</strong>
        <p>{{ $user->location->name ?? 'No asignado' }}</p>
    </div>
    <div>
        <strong>Fecha de creación:</strong>
        <p>{{ $user->created_at->format('d/m/Y') }}</p>
    </div>
    <div>
        <strong>Estado:</strong>
        <p>{{ $user->active ? 'Activo' : 'Inactivo' }}</p>
    </div>
</div>
