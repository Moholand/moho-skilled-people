<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\UserRoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRole\UserRoleCreateRequest;

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
     * @param  UserRoleCreateRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRoleCreateRequest $request, User $user)
    {
        $this->userRoleService->storeUserRole($request->role_id, $user->id);

        return response()->json([
            'message' => 'User role created successfully'
        ], 201);
    }
}
