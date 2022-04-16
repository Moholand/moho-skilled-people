<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    /**
     * @var RoleRepository $roleRepository
     */
    protected $roleRepository;

    /**
     * RoleService constructor.
     *
     * @param  RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get all the roles.
     */
    public function allRoles()
    {
        return $this->roleRepository->allRoles();
    }

    /**
     * Store a new role data.
     *
     * @param  array $data
     * @return \App\Models\Role
     */
    public function storeRole($data)
    {
        return $this->roleRepository->storeRole($data);
    }
}
