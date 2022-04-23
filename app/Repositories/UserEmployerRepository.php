<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Employer;
use Illuminate\Pagination\LengthAwarePaginator;

class UserEmployerRepository
{
    /**
     * Get all the employers.
     *
     * @param   User $user
     * @return LengthAwarePaginator
     */
    public function allUserEmployers(User $user): LengthAwarePaginator
    {
        return $user->employers()->with('users')->paginate(20)->withQueryString();
    }

    /**
     * Store a newly created employer in storage.
     *
     * @param   array $data
     * @param   User $user
     * @return Employer|\Illuminate\Database\Eloquent\Model
     */
    public function storeUserEmployer(array $data, User $user): Employer
    {
        return $user->employers()->create($data);
    }

    /**
     * Get one user employer data.
     *
     * @param  User $user
     * @param  int $id
     * @return Employer|\Illuminate\Database\Eloquent\Model
     */
    public function getUserEmployer(User $user, int $id): Employer
    {
        return $user->employers()->where('employer_id', $id)->firstOrFail();
    }

    /**
     * Get one user employer data, whether trashed or not.
     *
     * @param  User $user
     * @param  int $id
     * @return Employer|\Illuminate\Database\Eloquent\Model
     */
    public function getUserEmployerWithTrashed(User $user, int $id): Employer
    {
        return $user->employers()->withTrashed()->where('employer_id', $id)->firstOrFail();
    }

    /**
     * Update user employer data.
     *
     * @param  array $data
     * @param  User $user
     * @param  int $id
     * @return Employer
     */
    public function updateUserEmployer(array $data, User $user, int $id): Employer
    {
        $employer = $this->getUserEmployer($user, $id);

        $employer->update($data);

        return $employer;
    }

    /**
     * Delete user employer from storage.
     *
     * @param  User $user
     * @param  int $id
     * @return string
     */
    public function deleteUserEmployer(User $user, int $id): string
    {
        $employer = $this->getUserEmployerWithTrashed($user, $id);

        if($employer->trashed()) {
            $employer->forceDelete();
            return 'Employer deleted successfully';
        } else {
            $employer->delete();
            return 'Employer moved to trashed successfully';
        }
    }
}
