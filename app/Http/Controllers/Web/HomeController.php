<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Página principal del sistema (público o post-login).
     * Usa el layout corporativo con colores institucionales.
     */
    public function index()
    {
        return view('welcome');
    }
}
