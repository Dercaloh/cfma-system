<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $roleName = $user->role ? strtolower($user->role->name) : null;

    switch ($roleName) {
        case 'administrador':
            return view('dashboard.partials.admin');
        case 'aprendiz':
            return view('dashboard.partials.aprendiz');
        case 'funcionario':
            return view('dashboard.partials.funcionario');
        // Agrega más casos según roles y vistas
        default:
            return view('dashboard.index'); // Vista genérica o bienvenida
    }
}

}
