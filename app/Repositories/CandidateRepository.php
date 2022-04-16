<?php

namespace App\Repositories;

use App\Models\Candidate;
use Illuminate\Pagination\LengthAwarePaginator;

class CandidateRepository
{
    /**
     * Get all the candidates.
     */
    public function allCandidates(): LengthAwarePaginator
    {
        return Candidate::with('user')->paginate(20)->withQueryString();
    }

    /**
     * Store a new candidate data.
     *
     * @param  array $data
     * @return void
     */
    public function storeCandidate(array $data): void
    {
        Candidate::create([
            'user_id' => $data['user_id']
        ]);
    }

    /**
     * Update candidate data.
     *
     * @param  array $data
     * @param  int $id
     * @return Candidate
     */
    public function updateCandidate(array $data, int $id): Candidate
    {
        $candidate = Candidate::findOrFail($id);

        $candidate->update([
            'membership' => $data['membership']
        ]);

        return $candidate;
    }

    /**
     * Delete candidate from storage.
     *
     * @param  int $id
     * @return void
     */
    public function deleteCandidate(int $id): void
    {
        Candidate::findOrFail($id)->delete();
    }
}
