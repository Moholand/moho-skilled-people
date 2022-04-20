<?php

namespace App\Services;

use App\Models\Employer;
use App\Repositories\EmployerRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployerService
{
    /**
     * @var EmployerRepository $employerRepository
     */
    protected $employerRepository;

    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    /**
     * EmployerService constructor.
     *
     * @param  EmployerRepository $employerRepository
     */
    public function __construct(EmployerRepository $employerRepository, UserRepository $userRepository)
    {
        $this->employerRepository = $employerRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get all the employers.
     *
     * @return LengthAwarePaginator
     */
    public function allEmployers(): LengthAwarePaginator
    {
        return $this->employerRepository->allEmployers();
    }

    /**
     * Store a new employer data.
     *
     * @param  array $data
     * @return \App\Models\Employer
     */
    public function storeEmployer(array $data): Employer
    {
        $user_id = $data['user_id'];
        unset($data['user_id']);

        $user = $this->userRepository->getUser($user_id);

        return $this->employerRepository->storeEmployer($data, $user);
    }

    /**
     * Get the specified employer.
     *
     * @param  int  $id
     * @return \App\Models\Employer
     */
    public function getEmployer(int $id): Employer
    {
        return $this->employerRepository->getEmployer($id);
    }

    /**
     * Get one employer data by id, whether trashed or not.
     *
     * @param  int $id
     * @return \App\Models\Employer
     */
    public function getEmployerWithTrashed(int $id): Employer
    {
        return $this->employerRepository->getEmployerWithTrashed($id);
    }

    /**
     * Update employer data.
     *
     * @param  array $data
     * @param  int $id
     * @return \App\Models\Employer
     */
    public function updateEmployer(array $data, int $id): Employer
    {
        return $this->employerRepository->updateEmployer($data, $id);
    }

    /**
     * Delete employer from storage.
     *
     * @param  int $id
     * @return String
     */
    public function deleteEmployer(int $id): string
    {
        return $this->employerRepository->deleteEmployer($id);
    }
}
