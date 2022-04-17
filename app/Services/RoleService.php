<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Ramsey\Collection\Collection;

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
     *
     * @return Collection
     */
    public function allRoles(): Collection
    {
        return $this->roleRepository->allRoles();
    }

    /**
     * Store a new role data.
     *
     * @param  array $data
     * @return \App\Models\Role
     */
    public function storeRole(array $data): Role
    {
        return $this->roleRepository->storeRole($data);
    }
}
