<?php

namespace App\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Locations\Branch;
use App\Models\Locations\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Usuarios\StoreUsuarioRequest;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Users\UsersImport;
use App\Models\Position;

class UsuarioController extends Controller
{
    // Vista principal del módulo (listado de usuarios)
    public function index()
    {
        $users = User::with(['roles', 'department', 'location'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('usuarios.index', compact('users'));
    }

    // Formulario de registro individual
    public function create()
    {
        return view('usuarios.create', [
            'departments'    => Department::where('active', true)->orderBy('name')->get(),
            'branches'       => Branch::where('active', true)->orderBy('name')->get(),
            'locations'      => [], // se cargan por AJAX
            'positions'      => Position::where('active', true)->orderBy('title')->get(),
            'roles'          => Role::orderBy('name')->get(),
            'editableRoles'  => true
        ]);
    }




    // Almacena un nuevo usuario
    public function store(StoreUsuarioRequest $request)
    {
        try {
            $user = User::create([
                ...$request->validated(),
                'password' => Hash::make($request->password),
                'username' => Str::slug($request->first_name . '.' . $request->last_name),
            ]);

            $user->assignRole($request->role);

            return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar usuario: ' . $e->getMessage());
            return back()->withErrors('Error al registrar usuario.')->withInput();
        }
    }

    // Formulario de importación masiva
    public function import()
    {
        return view('usuarios.import');
    }

    // Procesa archivo importado
    public function handleImport(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,csv']
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->route('admin.usuarios.index')->with('success', 'Usuarios importados exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al importar usuarios: ' . $e->getMessage());
            return back()->withErrors('Error al importar el archivo. Asegúrese de que el formato sea correcto.');
        }
    }
}
