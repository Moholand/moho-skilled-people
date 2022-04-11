<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;

class UserRoleService
{
    /**
     * @var UserRoleRepository $userRoleRepository
     */
    protected $userRoleRepository;

    /**
     * UserRoleService constructor.
     *
     * @param  UserRoleRepository $userRoleRepository
     */
    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * Store a new role for the user.
     *
     * @param  int $role_id
     * @param  int $user_id
     * @return void
     */
    public function storeUserRole($role_id, $user_id)
    {
        $this->userRoleRepository->storeUserRole($role_id, $user_id);
    }

    /**
     * Delete role for the user.
     *
     * @param  int $user_id
     * @param  int $role_id
     * @return String
     */
    public function deleteUserRole($user_id, $role_id)
    {
        return $this->userRoleRepository->deleteUserRole($user_id, $role_id);
    }
}
