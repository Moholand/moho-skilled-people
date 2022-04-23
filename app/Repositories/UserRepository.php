<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * Get all the users.
     *
     * @return LengthAwarePaginator
     */
    public function allUsers(): LengthAwarePaginator
    {
        return User::with(['country', 'skills', 'roles'])->paginate(20)->withQueryString();
    }

    /**
     * Store a new user data.
     *
     * @param  array $data
     * @return User
     */
    public function storeUser(array $data): User
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
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function getUser(int $id): User
    {
        return User::with(['country', 'skills', 'roles'])->findOrFail($id);
    }

    /**
     * Get one user data by id, whether trashed or not.
     *
     * @param  int $id
     * @return User
     */
    public function getUserWithTrashed(int $id): User
    {
        return User::withTrashed()->findOrFail($id);
    }

    /**
     * Update user data.
     *
     * @param  array $data
     * @param  int $id
     * @return User
     */
    public function updateUser(array $data, int $id): User
    {
        $user = $this->getUser($id);

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
     * @return string
     */
    public function deleteUser(int $id): string
    {
        $user = $this->getUserWithTrashed($id);

        if($user->trashed()) {
            $user->forceDelete();
            return 'User deleted successfully';
        } else {
            $user->delete();
            return 'User moved to trashed successfully';
        }
    }

    /**
     * Restore user from storage.
     *
     * @param  int $id
     * @return void
     */
    public function restoreUser(int $id): void
    {
        User::onlyTrashed()->findOrFail($id)->restore();
    }

    /**
     * Get all the trashed users.
     *
     * @return LengthAwarePaginator
     */
    public function trashedUsers(): LengthAwarePaginator
    {
        return User::with(['country', 'skills'])->onlyTrashed()->paginate(20)->withQueryString();
    }
}
