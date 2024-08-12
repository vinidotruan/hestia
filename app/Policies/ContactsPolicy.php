<?php

namespace App\Policies;

use App\Models\Contacts;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ContactsPolicy
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
    public function view(User $user, Contacts $contacts): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * @param User $user
     * @param int $userId
     * @return bool
     */
    public function create(User $user, int $userId): bool
    {
        return $user->hasRole('admin') || $user->id === $userId;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contacts $contacts): bool
    {
        return $user->id === $contacts->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contacts $contacts): bool
    {
        return $user->id === $contacts->user_id || ($user->hasRole('admin'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contacts $contacts): bool
    {
        return $user->id === $contacts->user_id || ($user->hasRole('admin'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contacts $contacts): bool
    {
        return $user->hasRole('admin');
    }
}
