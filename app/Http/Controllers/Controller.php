<?php

namespace App\Http\Controllers;
use App\Http\Controllers\{
    Web\DashboardController,
    Web\ProfileController,
    Policy\UserPolicyController,
    Admin\UserRoleController,
    Admin\UserExportController,
    Admin\PolicyViewController,
    Admin\AuditoriaController,
    Inventory\AssetController,
    Inventory\ExitPassController,
    Inventory\GateController,
    Documents\DocumentController,
    Loans\LoanController,
    Security\UserSecurityLogController,
    Usuarios\UsuarioController
};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;
}
