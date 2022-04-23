<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{
    /**
     * Get all the roles.
     *
     * @return Collection
     */
    public function allRoles(): Collection
    {
        return Role::get();
    }

    /**
     * Store a new role data.
     *
     * @param  array $data
     * @return Role
     */
    public function storeRole(array $data): Role
    {
        return Role::create(['name' => $data['name']]);
    }
}
