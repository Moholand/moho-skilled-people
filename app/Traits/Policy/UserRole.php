<?php

namespace App\Traits\Policy;

use App\Models\Role;
use App\Models\User;

trait UserRole
{
    /**
     * Determine whether the user is admin or not.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function isAdmin(User $user): bool
    {
        return $user->roles()->get()->pluck('id')->contains(Role::ADMIN_ROLE_ID);
    }
}
