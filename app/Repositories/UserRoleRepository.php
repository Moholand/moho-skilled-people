<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserRoleRepository
{
    /**
     * Store a new role for the user.
     *
     * @param  int $user_id
     * @param  int $role_id
     * @return void
     */
    public function storeUserRole($user_id, $role_id)
    {
        DB::table('role_user')->insert([
            'user_id' => $user_id,
            'role_id' => $role_id
        ]);
    }

    /**
     * Check existence of role_user table record.
     *
     * @param  int $user_id
     * @param  int $role_id
     * @return bool
     */
    public function checkUserRole($user_id, $role_id)
    {
        return DB::table('role_user')
            ->where('user_id', $user_id)
            ->where('role_id', $role_id)
            ->exists();
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
        DB::table('role_user')
            ->where('user_id', $user_id)
            ->where('role_id', $role_id)
            ->delete();
    }
}
