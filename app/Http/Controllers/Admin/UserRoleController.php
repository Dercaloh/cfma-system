<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessControl\Role;
use App\Models\AccessControl\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    /**
     * Listado paginado de roles.
     * Vista: resources/views/roles/index.blade.php
     */
    public function index()
    {
        // 1. Autorización (p. ej. Gate o Policy de Role)
        $this->authorize('viewAny', Role::class);

        // 2. Obtener roles con paginación
        $roles = Role::with('permissions')
            ->orderBy('level')
            ->paginate(10);

        // 3. Auditoría
        activity('gestión de roles')
            ->causedBy(Auth::user())
            ->log('Visualizó listado de roles.');

        // 4. Retornar la vista correcta
        return view('access_control.roles.index', compact('users'));
    }

    /**
     * Formulario de edición de un rol.
     * Vista: resources/views/roles/edit.blade.php
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        // Todos los permisos disponibles
        $permissions = Permission::orderBy('name')->get();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Actualiza nombre, descripción y permisos de un rol.
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        // 1. Validar datos
        $data = $request->validate([
            'name'        => 'required|string|max:50|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // 2. Actualizar atributos básicos
        $role->fill([
            'name'        => $data['name'],
            'description' => $data['description'] ?? $role->description,
        ])->save();

        // 3. Sincronizar permisos
        $role->syncPermissions($data['permissions'] ?? []);

        // 4. Auditoría
        activity('gestión de roles')
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->withProperties([
                'name'        => $role->name,
                'permissions' => $role->permissions->pluck('name')->toArray(),
            ])
            ->log('Actualizó rol y permisos.');

        // 5. Redirigir al listado
        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }
}
