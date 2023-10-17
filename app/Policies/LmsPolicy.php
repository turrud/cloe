<?php

namespace App\Policies;

use App\Models\Lms;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LmsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lms can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the lms can view the model.
     */
    public function view(User $user, Lms $model): bool
    {
        return true;
    }

    /**
     * Determine whether the lms can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the lms can update the model.
     */
    public function update(User $user, Lms $model): bool
    {
        return true;
    }

    /**
     * Determine whether the lms can delete the model.
     */
    public function delete(User $user, Lms $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the lms can restore the model.
     */
    public function restore(User $user, Lms $model): bool
    {
        return false;
    }

    /**
     * Determine whether the lms can permanently delete the model.
     */
    public function forceDelete(User $user, Lms $model): bool
    {
        return false;
    }
}
