<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\AccessControl\Role;
use App\Models\Locations\Department;
use App\Models\Locations\Branch;
use App\Models\Programs\Position;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Users\StoreUsuarioRequest;
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

        return view('usuarios.index', compact('users'));
    }

    // 📝 Formulario de creación individual
    public function create()
    {
        return view('usuarios.create', [
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
        return view('usuarios.import');
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
}
