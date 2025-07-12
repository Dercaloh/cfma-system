<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\AccessControl\Role;
use App\Models\Locations\Department;
use App\Models\Locations\Branch;
use App\Models\Programs\Position;
use App\Models\AccessControl\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\StoreUsuarioRequest;
use App\Http\Requests\Users\UpdateUsuarioRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UsuarioController extends Controller
{
    // 🧾 Vista principal del módulo (listado)
    public function index()
    {
        $users = User::with(['roles', 'department', 'location'])
            ->orderByDesc('created_at')
            ->paginate(15);
        activity('gestión de usuarios y roles')
            ->causedBy(Auth::user())
            ->log('Visualizó listado de usuarios con roles y permisos.');


        return view('modules.usuarios.index', compact('users'));
    }

    // 📝 Formulario de creación individual
    public function create()
    {
        return view('modules.usuarios.create', [
            'departments'    => Department::where('active', true)->orderBy('name')->get(),
            'branches'       => Branch::where('active', true)->orderBy('name')->get(),
            'locations'      => [], // Carga por AJAX
            'positions'      => Position::where('active', true)->orderBy('title')->get(),
            'roles'          => Role::orderBy('name')->get(),
            'editableRoles'  => true,
        ]);
    }

    // 💾 Almacena nuevo usuario
    public function store(StoreUsuarioRequest $request)
    {
        try {
            // 1. Generar username único
            $baseUsername = Str::slug($request->first_name . '.' . $request->last_name);
            $username     = $this->generateUniqueUsername($baseUsername);

            // 2. Tomar sólo los campos válidos, EXCLUYENDO role y password_confirmation
            $datos = collect($request->validated())
                ->except(['role', 'password_confirmation'])
                ->toArray();

            // 3. Hashear y asignar contraseña, y asignar username
            $datos['password'] = Hash::make($request->password);
            $datos['username'] = $username;

            // 4. Crear el usuario
            $user = User::create($datos);

            // 5. Asignar rol
            $user->assignRole($request->role);

            return redirect()
                ->route('admin.usuarios.index')
                ->with('success', 'Usuario creado correctamente.');
        } catch (\Throwable $e) {
            Log::error("Error al registrar usuario en UsuarioController@store: {$e->getMessage()}");
            return back()
                ->withErrors('Error al registrar usuario. Verifica los datos e inténtalo de nuevo.')
                ->withInput();
        }
    }


    // 📥 Vista de importación
    public function import()
    {
        return view('modules.usuarios.import');
    }

    // 📤 Procesamiento del archivo importado
    public function handleImport(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,csv']
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));

            return redirect()
                ->route('admin.usuarios.index')
                ->with('success', 'Usuarios importados exitosamente.');
        } catch (\Throwable $e) {
            Log::error('Error al importar usuarios: ' . $e->getMessage());

            return back()
                ->withErrors('Error al importar el archivo. Verifique el formato y vuelva a intentarlo.')
                ->withInput();
        }
    }

    // 🔁 Generador único de username
    protected function generateUniqueUsername(string $base): string
    {
        $username = $base;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base . $counter;
            $counter++;
        }

        return $username;
    }
    public function edit(User $user)
    {
        $this->authorize('assignRoles', $user);

        // Obtener la sede del usuario
        $branch = Branch::with('locations')->find($user->branch_id);

        return view('modules.usuarios.edit', [
            'user'        => $user,
            'roles'       => Role::orderBy('level')->get(),
            'permissions' => Permission::orderBy('name')->get(),
            'departments' => Department::orderBy('name')->get(),
            'positions'   => Position::orderBy('title')->get(),
            'branches'    => Branch::orderBy('name')->get(), // 👈 Todas las sedes
            'locations'   => $branch ? $branch->locations->sortBy('name')->values() : collect(), // 👈 Solo las ubicaciones de la sede del usuario
        ]);
    }


    /**
     * Asigna roles y permisos a un usuario.
     */
    public function update(UpdateUsuarioRequest $request, User $user)
    {
        $this->authorize('assignRoles', $user);

        $data = $request->validated();

        // ✔️ Consentimientos booleanos
        $data['consent_data_sharing'] = $request->has('consent_data_sharing');
        $data['consent_marketing']    = $request->has('consent_marketing');

        // 🧼 Eliminar solo campos auxiliares que no existen en la base de datos
        unset($data['new_department'], $data['new_position'], $data['roles'], $data['permissions']);
        // ⛔️ Ya no se elimina 'position_id'

        // ✅ Actualizar usuario
        $user->update($data);

        // 🔐 Actualizar roles y permisos
        $user->syncRoles([$request->input('role')]);
        $user->syncPermissions($request->input('permissions', []));

        // 📝 Auditoría
        activity('actualización de usuario')
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'usuario_actualizado' => $data,
                'roles'               => $user->roles->pluck('name'),
                'permisos'            => $user->permissions->pluck('name'),
            ])
            ->log('Modificó la información general, roles y permisos del usuario.');

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }
}
