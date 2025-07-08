<?php

namespace App\AccessControl\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Policies\PolicyView;

class PolicyViewController extends Controller
{
    public function index()
    {
        $registros = PolicyView::with('user')->latest('viewed_at')->paginate(20);

        return view('admin.policy_views.index', compact('registros'));
    }
}
