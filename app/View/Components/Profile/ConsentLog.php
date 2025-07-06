<?php

namespace App\View\Components\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class ConsentLog extends Component
{
    public array $log;

    public function __construct()
    {
        $user = Auth::user();
        $latest = $user->latestPolicy('tratamiento_datos');

        $this->log = [
            'policy_version' => $latest?->policy_version ?? 'N/A',
            'accepted_at' => $latest?->accepted_at?->format('Y-m-d H:i') ?? 'N/A',
            'ip' => $latest?->accepted_ip ?? 'N/A',
            'agent' => $latest?->accepted_user_agent ?? 'N/A',
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.profile.consent-log');
    }
}
