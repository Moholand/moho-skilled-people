<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Candidate;
use App\Traits\Policy\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatePolicy
{
    use HandlesAuthorization, UserRole;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the Candidate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Candidate $candidate)
    {
        return $user->is($candidate->user) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the Candidate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Candidate $candidate)
    {
        return $user->is($candidate->user) || $this->isAdmin($user);
    }
}
