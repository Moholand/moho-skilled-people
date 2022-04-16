<?php

namespace App\Services;

use App\Models\Candidate;
use App\Repositories\CandidateRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CandidateService
{
    /**
     * @var CandidateRepository $candidateRepository
     */
    protected $candidateRepository;

    /**
     * CandidateService constructor.
     *
     * @param  CandidateRepository $candidateRepository
     */
    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    /**
     * Get all the candidates.
     */
    public function allCandidates(): LengthAwarePaginator
    {
        return $this->candidateRepository->allCandidates();
    }

    /**
     * Store a new candidate data.
     *
     * @param  array $data
     * @return void
     */
    public function storeCandidate(array $data): void
    {
        $this->candidateRepository->storeCandidate($data);
    }

    /**
     * Update candidate data.
     *
     * @param  array $data
     * @param  int $id
     * @return \App\Models\Candidate
     */
    public function updateCandidate(array $data, int $id): Candidate
    {
        return $this->candidateRepository->updateCandidate($data, $id);
    }

    /**
     * Delete candidate from storage.
     *
     * @param  int $id
     * @return void
     */
    public function deleteCandidate(int $id): void
    {
        $this->candidateRepository->deleteCandidate($id);
    }
}
