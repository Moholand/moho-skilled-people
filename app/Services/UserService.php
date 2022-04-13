<?php

namespace App\Services;

use App\Models\User;
use App\Events\UserRegistered;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param  UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all the users.
     */
    public function allUsers()
    {
        return $this->userRepository->allUsers();
    }

    /**
     * Store a new user data.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    public function storeUser(array $data): User
    {
        $role = $data['role'];
        unset($data['role']);

        $user = $this->userRepository->storeUser($data);

        // Event fired -> Add role for user listener
        UserRegistered::dispatch($user->id, $role);

        return $user;
    }

    /**
     * Get one user data by id.
     *
     * @param  int $id
     * @return \App\Models\User
     */
    public function getUser($id)
    {
        return $this->userRepository->getUser($id);
    }

    /**
     * Update user data.
     *
     * @param  array $data
     * @param  int $id
     * @return \App\Models\User
     */
    public function updateUser($data, $id)
    {
        return $this->userRepository->updateUser($data, $id);
    }

    /**
     * Delete user from storage.
     *
     * @param  int $id
     * @return String
     */
    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }

    /**
     * Restore the soft deleted user.
     *
     * @param  int $id
     * @return void
     */
    public function restoreUser($id)
    {
        $this->userRepository->restoreUser($id);
    }

    /**
     * Get all the trashed users.
     */
    public function trashedUsers()
    {
        return $this->userRepository->trashedUsers();
    }
}
