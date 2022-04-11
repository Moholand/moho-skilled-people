<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;

class UserRoleController extends Controller
{
    /**
     * @var UserRoleService $userRoleService
     */
    protected $userRoleService;

    /**
     * UserRoleController constructor.
     *
     * @param  UserRoleService $userRoleService
     */
    public function __construct(UserRoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    /**
     * Store a new role for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRoleCreateRequest $request, User $user)
    {
        $user = $this->userRoleService->storeUserRole($request->validated());

        return response()->json([
            'user' => new UserResource($user),
            'message' => 'User created successfully'
        ], 201);
    }
}
