<?php

namespace App\Policies;

use App\Models\LearningMaterial;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LearningMaterialPolicy
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
    public function view(User $user, LearningMaterial $learningMaterial): bool
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
    public function update(User $user, LearningMaterial $learningMaterial): bool
    {
        return $user->isRoot() || $user->isInstructor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LearningMaterial $learningMaterial): bool
    {
        return $user->isRoot();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LearningMaterial $learningMaterial): bool
    {
        return $user->isRoot();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LearningMaterial $learningMaterial): bool
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
