<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\EmployerCreateRequest;
use App\Http\Requests\Employer\EmployerUpdateRequest;
use App\Http\Resources\Employer\EmployerResource;
use App\Models\Employer;
use App\Services\EmployerService;

class EmployerController extends Controller
{
    /**
     * @var EmployerService $employerService
     */
    protected $employerService;

    /**
     * EmployerController constructor.
     *
     * @param  EmployerService $employerService
     */
    public function __construct(EmployerService $employerService)
    {
        $this->employerService = $employerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $employers = $this->employerService->allEmployers();

        return EmployerResource::collection($employers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmployerCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployerCreateRequest $request)
    {
        $this->authorize('create', Employer::class);

        $employer = $this->employerService->storeEmployer($request->validated());

        return response()->json([
            'user' => new EmployerResource($employer),
            'message' => 'Employer created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return EmployerResource
     */
    public function show(int $id)
    {
        $employer = $this->employerService->getEmployer($id);

        return new EmployerResource($employer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmployerUpdateRequest $request
     * @param  Employer $employer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployerUpdateRequest $request, Employer $employer)
    {
        $this->authorize('update', $employer);

        $employer = $this->employerService->updateEmployer($request->validated(), $employer->id);

        return response()->json([
            'employer' => new EmployerResource($employer),
            'message' => 'Employer updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $employer = $this->employerService->getEmployerWithTrashed($id);

        $this->authorize('delete', $employer);

        $result = $this->employerService->deleteEmployer($employer->id);

        return response()->json(['message' => $result]);
    }
}
