<?php

namespace App\Http\Controllers\Api;

use App\Models\Candidate;
use App\Http\Controllers\Controller;
use App\Services\CandidateService;
use App\Http\Resources\Candidate\CandidateResource;
use App\Http\Requests\Candidate\CandidateUpdateRequest;

class CandidateController extends Controller
{
    /**
     * @var CandidateService $candidateService
     */
    protected $candidateService;

    /**
     * CandidateController constructor.
     *
     * @param  CandidateService $candidateService
     */
    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('viewAny', Candidate::class);

        $candidates = $this->candidateService->allCandidates();

        return CandidateResource::collection($candidates);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CandidateUpdateRequest $request
     * @param  Candidate $candidate
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CandidateUpdateRequest $request, Candidate $candidate)
    {
        $this->authorize('update', $candidate);

        $candidate = $this->candidateService->updateCandidate($request->validated(), $candidate->id);

        return response()->json([
            'candidate' => new CandidateResource($candidate),
            'message' => 'Candidate updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Candidate $candidate
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $candidate = $this->candidateService->getCandidateWithTrashed($id);

        $this->authorize('delete', $candidate);

        $result = $this->candidateService->deleteCandidate($id);

        return response()->json(['message' => $result]);
    }
}
