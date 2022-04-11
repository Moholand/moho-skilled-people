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
     * @param  int $user_id
     * @param  int $role_id
     * @return void
     */
    public function storeUserRole($user_id, $role_id)
    {
        if($this->userRoleRepository->checkUserRole($user_id, $role_id)) {
            abort(409);
        };

        $this->userRoleRepository->storeUserRole($user_id, $role_id);
    }

    /**
     * Delete role for the user.
     *
     * @param  int $user_id
     * @param  int $role_id
     * @return void
     */
    public function deleteUserRole($user_id, $role_id)
    {
        if(!$this->userRoleRepository->checkUserRole($user_id, $role_id)) {
            abort(409);
        };

        $this->userRoleRepository->deleteUserRole($user_id, $role_id);
    }
}
