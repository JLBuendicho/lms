<?php

namespace App\Policies;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isRoot() || $user->isInstructor();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Subjects $subject): bool
    {
        return $user->isRoot() || $user->isInstructor();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isRoot() || $user->isInstructor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Subjects $subject): bool
    {
        return $user->isRoot() || $user->isInstructor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Subjects $subject): bool
    {
        return $user->isRoot();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Subjects $subject): bool
    {
        return $user->isRoot();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Subjects $subject): bool
    {
        return $user->isRoot();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isRoot();
    }

    public function restoreAny(User $user): bool
    {
        return $user->isRoot();
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->isRoot();
    }
}
