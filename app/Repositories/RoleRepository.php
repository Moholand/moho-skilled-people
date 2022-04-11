<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    /**
     * Get all the roles.
     */
    public function allRoles()
    {
        return Role::get();
    }
}
