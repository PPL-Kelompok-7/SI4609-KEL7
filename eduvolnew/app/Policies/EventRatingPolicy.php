<?php

namespace App\Policies;

use App\Models\EventRating;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventRatingPolicy
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
    public function view(User $user, EventRating $eventRating): bool
    {
        return true;
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
    public function update(User $user, EventRating $eventRating): bool
    {
        return $user->id === $eventRating->user_id || $user->role_id === 1; // Admin or owner
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventRating $eventRating): bool
    {
        return $user->id === $eventRating->user_id || $user->role_id === 1; // Admin or owner
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EventRating $eventRating): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EventRating $eventRating): bool
    {
        return false;
    }
}
