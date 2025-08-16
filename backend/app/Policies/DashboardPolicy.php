<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dashboard;

class DashboardPolicy
{
    /**
     * Determine if the given user can view the dashboard.
     */
    public function view(User $user, Dashboard $dashboard): bool
    {
        return $user->id === $dashboard->user_id;
    }

    /**
     * Determine if the user can create dashboards.
     */
    public function create(User $user): bool
    {
        return true; // any authenticated user can create
    }

    /**
     * Determine if the user can update the dashboard.
     */
    public function update(User $user, Dashboard $dashboard): bool
    {
        return $user->id === $dashboard->user_id;
    }

    /**
     * Determine if the user can delete the dashboard.
     */
    public function delete(User $user, Dashboard $dashboard): bool
    {
        return $user->id === $dashboard->user_id;
    }

    /**
     * Determine if the user can rollback a dashboard version.
     */
    public function rollback(User $user, Dashboard $dashboard): bool
    {
        return $user->id === $dashboard->user_id;
    }
}
