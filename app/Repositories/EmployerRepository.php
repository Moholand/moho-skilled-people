<?php

namespace App\Repositories;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployerRepository
{
    /**
     * Get all the employers.
     *
     * @return LengthAwarePaginator
     */
    public function allEmployers(): LengthAwarePaginator
    {
        return Employer::with('users')->paginate(20)->withQueryString();
    }

    /**
     * Store a new employer data.
     *
     * @param  array $data
     * @param  User $user
     * @return Employer|\Illuminate\Database\Eloquent\Model
     */
    public function storeEmployer(array $data, User $user): Employer
    {
        return $user->employers()->create([
            'company_name' => $data['company_name'],
            'company_email' => $data['company_email'],
            'company_address' => $data['company_address']
        ]);
    }

    /**
     * Get the specified employer.
     *
     * @param  int  $id
     * @return Employer|\Illuminate\Database\Eloquent\Model
     */
    public function getEmployer(int $id): Employer
    {
        return Employer::with('users')->findOrFail($id);
    }

    /**
     * Get one employer data by id, whether trashed or not.
     *
     * @param  int $id
     * @return Employer
     */
    public function getEmployerWithTrashed(int $id): Employer
    {
        return Employer::withTrashed()->findOrFail($id);
    }

    /**
     * Update employer data.
     *
     * @param  array $data
     * @param  int $id
     * @return Employer
     */
    public function updateEmployer(array $data, int $id): Employer
    {
        $employer = $this->getEmployer($id);

        $employer->update($data);

        return $employer;
    }

    /**
     * Delete employer from storage.
     *
     * @param  int $id
     * @return String
     */
    public function deleteEmployer(int $id): string
    {
        $employer = $this->getEmployerWithTrashed($id);

        if($employer->trashed()) {
            $employer->forceDelete();
            return 'Employer deleted successfully';
        } else {
            $employer->delete();
            return 'Employer moved to trashed successfully';
        }
    }
}
