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
     * @return \App\Models\User
     */
    public function storeUser($data)
    {
        return $this->userRepository->storeUser($data);
    }

    /**
     * Get one user data by id.
     *
     * @param  int $id
     * @return \App\Models\User
     */
    public function getUser($id)
    {
        $user = $this->userRepository->getUser($id);

        if (auth()->user()->cannot('view', $user)) {
            abort(403);
        }

        return $user;
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
        $user = $this->userRepository->getUser($id);

        if(auth()->user()->cannot('update', $user)) {
            abort(403);
        }

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
        $user = $this->userRepository->getUser($id);

        if(auth()->user()->cannot('delete', $user) || auth()->user()->cannot('forceDelete', $user)) {
            abort(403);
        }

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
