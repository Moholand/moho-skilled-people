<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAllUser()
    {
        return User::with(['country', 'skills'])->paginate(20)->withQueryString();
    }
}
