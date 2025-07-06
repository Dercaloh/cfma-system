<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determina si el usuario autenticado puede ver el listado de usuarios.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['Administrador', 'Subdirector', 'Coordinador']);
    }

    /**
     * Determina si el usuario autenticado puede ver un usuario específico.
     */
    public function view(User $user, User $model): bool
    {
        // Puede verse a sí mismo o si tiene rol administrador
        return $user->id === $model->id || $user->hasRole(['Administrador', 'Subdirector']);
    }

    /**
     * Determina si el usuario autenticado puede actualizar los datos del usuario.
     */
    public function update(User $user, User $model): bool
    {
        // Puede actualizarse a sí mismo o tener permiso de gestión
        return $user->id === $model->id || $user->hasRole('Administrador');
    }

    /**
     * Determina si el usuario autenticado puede eliminar usuarios.
     */
    public function delete(User $user, User $model): bool
    {
        // Solo los administradores pueden eliminar y no a sí mismos
        return $user->hasRole('Administrador') && $user->id !== $model->id;
    }

    /**
     * Determina si el usuario autenticado puede asignar roles y permisos.
     */
    public function assignRoles(User $user): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Determina si puede crear nuevos usuarios.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Determina si puede restaurar usuarios eliminados (SoftDeletes).
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasRole('Administrador');
    }

    /**
     * Determina si puede ver registros de auditoría de un usuario.
     */
    public function viewLogs(User $user, User $model): bool
    {
        return $user->hasRole('Administrador') || $user->id === $model->id;
    }
}
