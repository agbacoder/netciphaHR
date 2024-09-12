<?php

namespace App\Policies;

use App\Models\Users;
use App\Models\employees;
use Illuminate\Auth\Access\Response;

class EmployeesPolicy
{
    /**
     * Determine whether the users can view any models.
     */
    // public function viewAny(Users $users): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the users can view the model.
    //  */
    // public function view(Users $users, employees $employees): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the users can create models.
    //  */
    // public function create(Users $users): bool
    // {
    //     //
    // }

    /**
     * Determine whether the users can update the model.
     */
    public function update(Users $users, employees $employees): bool
    {
        if ($users->hasPermissionTo('edit employees')) {
            return true;
        }

        // Otherwise, allow the user to update their own data only
        return $users->user_id === $employees->user_id;

    }

    /**
     * Determine whether the users can delete the model.
     */
    // public function delete(Users $users, employees $employees): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the users can restore the model.
    //  */
    // public function restore(Users $users, employees $employees): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the users can permanently delete the model.
    //  */
    // public function forceDelete(Users $users, employees $employees): bool
    // {
    //     //
    // }
}
