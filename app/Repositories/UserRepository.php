<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function getAllUser()
    {
        return User::with(['country', 'skills'])->paginate(20)->withQueryString();
    }

    public function storeUserData($data)
    {
        return User::create([
            'english_full_name' => $data['english_full_name'],
            'persian_full_name' => $data['persian_full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id']
        ]);
    }

    public function updatePostData($data, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'english_full_name' => $data['english_full_name'],
            'persian_full_name' => $data['persian_full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id']
        ]);

        return $user;
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }
}
