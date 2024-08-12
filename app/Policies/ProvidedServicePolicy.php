<?php

namespace App\Policies;

use App\Models\ProvidedServices;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class ProvidedServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProvidedServices $providedServices): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('ong');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProvidedServices $providedServices): bool
    {
        return $user->id === $providedServices->user_id && ($user->hasRole('admin') || $user->hasRole('ong'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProvidedServices $providedServices): bool
    {
        return $user->id === $providedServices->user_id && ($user->hasRole('admin') || $user->hasRole('ong'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProvidedServices $providedServices): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProvidedServices $providedServices): bool
    {
        return $user->hasRole('admin');
    }
}
