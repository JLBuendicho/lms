<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsPolicy
{
    // Only "root" users can see the log
    public function viewAny(User $user): bool
    {
        return $user->role === 'root';
    }

    public function view(User $user, Activity $activity): bool
    {
        return $user->role === 'root';
    }

    // Audit logs are append-only: nobody edits or deletes them from the UI
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Activity $activity): bool
    {
        return false;
    }

    public function delete(User $user, Activity $activity): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Activity $activity): bool
    {
        return false;
    }

    public function forceDelete(User $user, Activity $activity): bool
    {
        return false;
    }
}