<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserRoleRepository
{
    /**
     * Store a new role for the user.
     *
     * @param  int $role_id
     * @param  int $user_id
     * @return void
     */
    public function storeUserRole($role_id, $user_id)
    {
        DB::table('role_user')->insert([
            'role_id' => $role_id,
            'user_id' => $user_id
        ]);
    }
}
