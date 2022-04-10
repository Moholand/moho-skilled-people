<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * Get all the users.
     */
    public function allUsers()
    {
        return User::with(['country', 'skills'])->paginate(20)->withQueryString();
    }

    /**
     * Store a new user data.
     *
     * @param  array $data
     * @return User
     */
    public function storeUser($data)
    {
        return User::create([
            'english_full_name' => $data['english_full_name'],
            'persian_full_name' => $data['persian_full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id']
        ]);
    }

    /**
     * Get one user data by id.
     *
     * @param  int $id
     * @return User
     */
    public function getUser($id)
    {
        return User::findOrFail($id);
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

    /**
     * Delete user from storage.
     *
     * @param  int $id
     * @return String
     */
    public function deleteUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if($user->trashed()) {
            $user->forceDelete();
            return $result = 'User deleted successfully';
        } else {
            $user->delete();
            return $result = 'User moved to trashed successfully';
        }
    }

    /**
     * Restore user from storage.
     *
     * @param  int $id
     * @return void
     */
    public function restoreUser($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
    }

    /**
     * Get all the trashed users.
     */
    public function trashedUsers()
    {
        return User::with(['country', 'skills'])->onlyTrashed()->paginate(20)->withQueryString();
    }
}
