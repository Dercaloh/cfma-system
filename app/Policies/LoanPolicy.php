<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;

class LoanPolicy
{
    public function view(User $user, Loan $loan): bool
    {
        return $user->id === $loan->user_id || $user->role->name === 'subdirector';
    }

    public function approve(User $user, Loan $loan): bool
    {
        return $user->role->name === 'subdirector' && $loan->status->name === 'pendiente';
    }

    public function returnAsset(User $user, Loan $loan): bool
    {
        return $user->role->name === 'portería' && $loan->status->name === 'entregado';
    }
}
