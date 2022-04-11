<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
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
        $this->authorize('addRole', User::class);

        $this->userRoleService->storeUserRole($user->id, $request->role_id);

        return response()->json([
            'message' => 'User role created successfully'
        ], 201);
    }

    /**
     * Remove the specified role from the user.
     *
     * @param  User $user
     * @param  Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user, Role $role)
    {
        $this->authorize('deleteRole', User::class);

        $this->userRoleService->deleteUserRole($user->id, $role->id);

        return response()->json(['message' => 'User role deleted successfully']);
    }
}
