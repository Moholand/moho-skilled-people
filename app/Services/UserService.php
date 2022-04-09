<?php

namespace App\Services;

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
     * @return User
     */
    public function storeUser($data)
    {
        return $this->userRepository->storeUser($data);
    }

    /**
     * Get one user data by id.
     *
     * @param  int $id
     * @return User
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
     * @return User
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
}
