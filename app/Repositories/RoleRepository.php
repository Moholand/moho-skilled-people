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

    /**
     * Store a new role data.
     *
     * @param  array $data
     * @return Role
     */
    public function storeRole($data)
    {
        return Role::create(['name' => $data['name']]);
    }
}
