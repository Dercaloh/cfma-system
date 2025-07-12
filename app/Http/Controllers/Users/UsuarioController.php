<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\AccessControl\Role;
use App\Models\AccessControl\Permission;
use App\Models\Locations\Department;
use App\Models\Locations\Branch;
use App\Models\Programs\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\Users\StoreUsuarioRequest;
use App\Http\Requests\Users\UpdateUsuarioRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;


class UsuarioController extends Controller
{

    public function show(User $user)
    {
        $this->authorize('view', $user); // Opcional si usas políticas
        return view('modules.usuarios.show', compact('user'));
    }

    // 🧾 Listado de usuarios
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

    // 📝 Formulario de creación
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

    // 💾 Guardar usuario nuevo
 public function store(StoreUsuarioRequest $request)
    {
        try {
            $baseUsername = Str::slug($request->first_name . '.' . $request->last_name);
            $username = $this->generateUniqueUsername($baseUsername);

            $data = collect($request->validated())
                ->except(['role', 'password_confirmation'])
                ->toArray();

            $data['email'] = $request->institutional_email;
            $data['password'] = Hash::make($request->password);
            $data['username'] = $username;

            $user = User::create($data);
            $user->assignRole($request->role);

            return redirect()
                ->route('admin.usuarios.index')
                ->with('success', 'Usuario creado correctamente.');
        } catch (\Throwable $e) {
            Log::error("Error al registrar usuario: {$e->getMessage()}");
            return back()
                ->withErrors('Error al registrar usuario. Por favor verifique los datos e inténtelo de nuevo.')
                ->withInput();
        }
    }

    // 🔁 Editar usuario
    public function edit(User $user)
    {
        $this->authorize('assignRoles', $user);

        $branch = Branch::with('locations')->find($user->branch_id);

        return view('modules.usuarios.edit', [
            'user'        => $user,
            'roles'       => Role::orderBy('level')->get(),
            'permissions' => Permission::orderBy('name')->get(),
            'departments' => Department::orderBy('name')->get(),
            'positions'   => Position::orderBy('title')->get(),
            'branches'    => Branch::orderBy('name')->get(),
            'locations'   => $branch ? $branch->locations->sortBy('name')->values() : collect(),
        ]);
    }

    // ✅ Actualizar usuario
    public function update(UpdateUsuarioRequest $request, User $user)
    {
        $this->authorize('assignRoles', $user);

        $data = $request->validated();

        // 🔒 Actualizar consentimientos booleanos
        $data['consent_data_sharing'] = $request->has('consent_data_sharing');
        $data['consent_marketing'] = $request->has('consent_marketing');

        // 🧼 Eliminar campos auxiliares
        unset($data['new_department'], $data['new_position'], $data['roles'], $data['permissions']);

        $user->update($data);

        $user->syncRoles([$request->input('role')]);
        $user->syncPermissions($request->input('permissions', []));

        activity('actualización de usuario')
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'usuario_actualizado' => $data,
                'roles' => $user->roles->pluck('name'),
                'permisos' => $user->permissions->pluck('name'),
            ])
            ->log('Modificó la información general, roles y permisos del usuario.');

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    // 📥 Vista para importar
    public function import()
    {
        return view('modules.usuarios.import');
    }

    // 📤 Procesar archivo importado
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
}
