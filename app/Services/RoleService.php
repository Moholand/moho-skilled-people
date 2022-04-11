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
}
