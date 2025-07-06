<?php
namespace App\Exports;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;


class UsersPdfExport
{
    public function generate()
    {
        $users = User::with(['roles','permissions','department','location'])->get();

        $pdf = PDF::loadView('exports.users_pdf', compact('users'));
        return $pdf->stream('usuarios.pdf');
    }
}
