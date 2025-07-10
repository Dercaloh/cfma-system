<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\AccessControl\Role;
use App\Models\AccessControl\Permission;
use App\Models\Programs\Position;
use App\Models\Locations\Department; // Asegúrate que esta ruta sea correcta
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    /**
     * Muestra listado de usuarios con sus roles y permisos.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::with(['roles', 'permissions', 'department', 'location'])
            ->orderBy('full_name')
            ->paginate(10);

        activity('gestión de usuarios y roles')
            ->causedBy(Auth::user())
            ->log('Visualizó listado de usuarios con roles y permisos.');

        return view('access_control.roles.index', compact('users'));
    }

    /**
     * Formulario para editar los roles de un usuario.
     */
    public function edit(User $user)
    {
        $this->authorize('assignRoles', $user);

        $roles = Role::orderBy('level')->get();
        $permissions = Permission::orderBy('name')->get();
        $departments = Department::orderBy('name')->get(); // ← Corregido aquí
        $positions = Position::orderBy('title')->get();
        return view('access_control.roles.edit', compact('user', 'roles', 'permissions', 'departments','positions' ));
    }

    /**
     * Asigna roles y permisos a un usuario.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('assignRoles', $user);

        $data = $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $user->syncRoles($data['roles'] ?? []);
        $user->syncPermissions($data['permissions'] ?? []);

        activity('asignación de roles')
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'roles' => $user->roles->pluck('name')->toArray(),
                'permissions' => $user->permissions->pluck('name')->toArray(),
            ])
            ->log('Actualizó roles y permisos del usuario.');

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Roles y permisos actualizados correctamente.');
    }
}
