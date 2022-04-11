<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        $roles_id = $this->getRolesId($user);

        return in_array(Role::IS_ADMIN, $roles_id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $roles_id = $this->getRolesId($user);

        return in_array(Role::IS_ADMIN, $roles_id);
    }

    /**
     * Determine current user roles id.
     *
     * @param  \App\Models\User  $user
     * @return array
     */
    protected function getRolesId($user): array
    {
        return $user->roles()->get()->pluck('id')->toArray();
    }
}
