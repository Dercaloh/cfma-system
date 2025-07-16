<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\UsersBackupExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UserBackupController extends Controller
{
    public function export(Request $request)
    {
        $fileName = 'backup_usuarios_sin_consentimientos_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new UsersBackupExport, $fileName);
    }
}
