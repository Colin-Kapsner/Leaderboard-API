<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Time;



class TimePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

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
    public function view(User $user, Time $time): bool
    {
        return $user->id == $time->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Time $time): bool
    {
        return $user->id == $time->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Time $time): bool
    {
        return $user->id == $time->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Time $time): bool
    {
        return $user->id == $time->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Time $time): bool
    {
        return $user->id == $time->user_id;
    }
}
