<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    protected $except = [
        // Aquí puedes agregar cookies que no quieras cifrar
    ];
}

