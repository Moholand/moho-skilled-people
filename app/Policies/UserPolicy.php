<?php

namespace App\Policies;

use App\Models\User;
use App\Traits\Policy\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization, UserRole;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return $user->is($model);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return $user->is($model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return $user->is($model) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can view all the trashed model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function trashed(User $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently add role for the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function addRole(User $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete role for the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteRole(User $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently create employer.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createEmployer(User $user, User $model)
    {
        return $this->isEmployer($model) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the employer.
     *
     * @param  \App\Models\User  $user
     * @param  int $employer_id
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateEmployer(User $user, User $model, int $employer_id)
    {
        return $model->employers->contains($employer_id) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the employer.
     *
     * @param  \App\Models\User  $user
     * @param  int $employer_id
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteEmployer(User $user, User $model, int $employer_id)
    {
        return $model->employers->contains($employer_id) || $this->isAdmin($user);
    }
}
