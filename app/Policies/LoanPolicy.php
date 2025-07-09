<?php

namespace App\Policies;

use App\Models\Users\User;
use App\Models\Loans\Loan;
class LoanPolicy
{
    /**
     * Permite visualizar el préstamo si:
     * - el usuario es el solicitante,
     * - el usuario tiene asignado el activo (cuentadante/receptor),
     * - el usuario tiene un rol con privilegios (subdirector o admin).
     */
   public function view(User $user, Loan $loan): bool
    {
        $isSolicitante = $user->id === $loan->user_id;
        $isCuentadante = $loan->asset && $loan->asset->assigned_to === $user->id;
        $isAutorizado = in_array($user->role?->name, ['subdirector', 'administrador']); // nota: en la tabla es 'administrador', no 'admin'

        return $isSolicitante || $isCuentadante || $isAutorizado;
    }


    /**
     * Permite aprobar un préstamo si:
     * - el préstamo está en estado 'solicitado',
     * - el usuario es el cuentadante del activo (receptor).
     */
    public function approve(User $user, Loan $loan): bool
{
    return $loan->status?->name === 'solicitado' && (
        $loan->asset?->assigned_to === $user->id ||
        in_array($user->role?->name, ['subdirector', 'administrador'])
    );
}


    /**
     * Permite registrar la entrega si:
     * - el préstamo está en estado 'aprobado',
     * - el usuario es el cuentadante del activo (receptor).
     */
    public function deliver(User $user, Loan $loan): bool
    {
        return $loan->status?->name === 'aprobado'
            && $loan->asset?->assigned_to === $user->id;
    }

    /**
     * Permite registrar la devolución si:
     * - el préstamo está en estado 'entregado',
     * - el usuario es el cuentadante del activo (receptor).
     */
    public function returnAsset(User $user, Loan $loan): bool
    {
        return $loan->status?->name === 'entregado'
            && $loan->asset?->assigned_to === $user->id;
    }
}
