<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileTitle extends Component
{
    /**
     * Crea una nueva instancia del componente.
     */
    public function __construct()
    {
        // Puedes inicializar props aquí si lo necesitas
    }

    /**
     * Obtiene la vista o contenido del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.profile-title');
    }
}
