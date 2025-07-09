<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Locations\Department;
use App\Models\Programs\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessControl\Role;
use App\Models\AccessControl\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserRoleController extends Controller
{
    /**
     * Muestra listado paginado de usuarios con sus roles/permisos.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class); // Política de acceso granular

        $users = User::with(['roles', 'permissions', 'department', 'location'])
            ->orderBy('last_name')
            ->paginate(10);

        activity('gestión de roles y permisos')
            ->causedBy(Auth::user())
            ->log('Visualizó listado de usuarios con sus roles y permisos.');

        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el formulario de edición de roles, permisos, área y cargo.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::orderBy('level')->get();
        $permissions = Permission::all();
        $departments = Department::where('active', true)->orderBy('name')->get();
        $positions = Position::where('active', true)->orderBy('title')->get();

        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'departments', 'positions'));
    }

    /**
     * Actualiza la asignación de roles, permisos, área y cargo del usuario.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'department_id'    => 'nullable|exists:departments,id',
            'position_id'      => 'nullable|exists:positions,id',
            'new_department'   => 'nullable|string|max:255',
            'new_position'     => 'nullable|string|max:255',
            'roles'            => 'nullable|array',
            'roles.*'          => 'exists:roles,name',
            'permissions'      => 'nullable|array',
            'permissions.*'    => 'exists:permissions,name',
        ]);

        // Asignación de nueva área (departamento)
        if ($request->filled('new_department')) {
            $department = Department::create([
                'name'       => trim($request->new_department),
                'active'     => true,
                'created_by' => Auth::id(),
            ]);
            $user->department_id = $department->id;
        } elseif ($request->filled('department_id')) {
            $user->department_id = $request->department_id;
        }

        // Asignación de nuevo cargo
        if ($request->filled('new_position')) {
            $position = Position::create([
                'title'      => trim($request->new_position),
                'active'     => true,
                'created_by' => Auth::id(),
            ]);
            $user->job_title = $position->title;
        } elseif ($request->filled('position_id')) {
            $user->job_title = Position::find($request->position_id)?->title;
        }

        // Asignación de roles y permisos
        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));

        $user->save();

        // Registro de auditoría con Spatie
        activity('gestión de roles y permisos')
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'roles'        => $request->input('roles', []),
                'permissions'  => $request->input('permissions', []),
                'department'   => $user->department?->name,
                'position'     => $user->job_title,
            ])
            ->log('Actualizó roles, permisos, área y cargo del usuario.');

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }
}
