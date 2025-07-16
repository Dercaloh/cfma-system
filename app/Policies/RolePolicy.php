<?php

namespace App\Policies;

use App\Models\AccessControl\Role;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Ver todos los roles.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Ver un rol específico.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Actualizar un rol.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Crear roles.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Eliminar roles.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasRole('Administrador');
    }
}
