<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    Protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
