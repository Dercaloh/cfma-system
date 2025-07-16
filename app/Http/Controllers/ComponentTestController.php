<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentTestController extends Controller
{
    /**
     * Muestra la vista de prueba de componentes.
     */
    public function index()
    {
        // Si deseas agregar control de permisos, puedes usar:
        // $this->authorize('ver componentes de prueba');

        return view('components-test');
    }
}
