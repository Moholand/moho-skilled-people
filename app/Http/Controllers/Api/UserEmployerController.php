<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UserEmployerService;
use App\Http\Requests\UserEmployer\UserEmployerCreateRequest;
use App\Http\Requests\UserEmployer\UserEmployerUpdateRequest;
use App\Http\Resources\Employer\EmployerResource;

class UserEmployerController extends Controller
{
    /**
     * @var UserEmployerService $userEmployerService
     */
    protected $userEmployerService;

    /**
     * UserEmployerController constructor.
     *
     * @param  UserEmployerService $userEmployerService
     */
    public function __construct(UserEmployerService $userEmployerService)
    {
        $this->userEmployerService = $userEmployerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(User $user)
    {
        $employers = $this->userEmployerService->allUserEmployers($user);

        return EmployerResource::collection($employers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserEmployerCreateRequest  $request
     * @param  User $user
     * @return EmployerResource
     */
    public function store(UserEmployerCreateRequest $request, User $user)
    {
        $this->authorize('createEmployer', $user);

        $employer = $this->userEmployerService->storeUserEmployer($request->validated(), $user);

        return new EmployerResource($employer);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @param  int $id
     * @return EmployerResource
     */
    public function show(User $user, int $id)
    {
        $employer = $this->userEmployerService->getUserEmployer($user, $id);

        return new EmployerResource($employer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserEmployerUpdateRequest $request
     * @param  User $user
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserEmployerUpdateRequest $request, User $user, int $id)
    {
        $this->authorize('updateEmployer', [$user, $id]);

        $employer = $this->userEmployerService->updateUserEmployer($request->validated(), $user, $id);

        return response()->json([
            'employer' => new EmployerResource($employer),
            'message' => 'Employer updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user, int $id)
    {
        $this->authorize('deleteEmployer', [$user, $id]);

        $result = $this->userEmployerService->deleteUserEmployer($user, $id);

        return response()->json(['message' => $result]);
    }
}
