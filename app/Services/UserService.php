<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAllUser();
    }

    public function storeUser($data)
    {
        return $this->userRepository->storeUserData($data);
    }

    public function updatePost($data, $id)
    {
        return $this->userRepository->updatePostData($data, $id);
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
