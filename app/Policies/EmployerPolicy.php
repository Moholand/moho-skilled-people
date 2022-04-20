<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employer;
use App\Traits\Policy\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerPolicy
{
    use HandlesAuthorization, UserRole;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->isEmployer($user) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Employer $employer)
    {
        return $employer->users->contains($user) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Employer $employer)
    {
        return $employer->users->contains($user) || $this->isAdmin($user);
    }
}
