<?php

namespace App\Services;

use App\Models\User;
use App\Models\Employer;
use App\Repositories\UserEmployerRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserEmployerService
{
    /**
     * @var UserEmployerRepository $userEmployerRepository
     */
    protected $userEmployerRepository;

    /**
     * EmployerService constructor.
     *
     * @param  UserEmployerRepository $userEmployerRepository
     */
    public function __construct(UserEmployerRepository $userEmployerRepository)
    {
        $this->userEmployerRepository = $userEmployerRepository;
    }

    /**
     * Get all the employers.
     *
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function allUserEmployers(User $user): LengthAwarePaginator
    {
        return $this->userEmployerRepository->allUserEmployers($user);
    }

    /**
     * Store a newly created employer in storage.
     *
     * @param   array $data
     * @param   User $user
     * @return  \App\Models\Employer|\Illuminate\Database\Eloquent\Model
     */
    public function storeUserEmployer(array $data, User $user): Employer
    {
        return $this->userEmployerRepository->storeUserEmployer($data, $user);
    }

    /**
     * Get one user employer data.
     *
     * @param  User $user
     * @param  int $id
     * @return \App\Models\Employer
     */
    public function getUserEmployer(User $user, int $id): Employer
    {
        return $this->userEmployerRepository->getUserEmployer($user, $id);
    }

    /**
     * Update user employer data.
     *
     * @param  array $data
     * @param  User $user
     * @param  int $id
     * @return \App\Models\Employer
     */
    public function updateUserEmployer(array $data, User $user, int $id): Employer
    {
        return $this->userEmployerRepository->updateUserEmployer($data, $user, $id);
    }

    /**
     * Delete user employer from storage.
     *
     * @param  User $user
     * @param  int $id
     * @return String
     */
    public function deleteUserEmployer(User $user, int $id): string
    {
        return $this->userEmployerRepository->deleteUserEmployer($user, $id);
    }
}
