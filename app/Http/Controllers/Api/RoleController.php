<?php

namespace App\Http\Controllers\Api;

use App\Services\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use App\Http\Requests\Role\RoleCreateRequest;


class RoleController extends Controller
{
    /**
     * @var RoleService $roleService
     */
    protected $roleService;

    /**
     * RoleController constructor.
     *
     * @param  RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $roles = $this->roleService->allRoles();

        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleCreateRequest $request)
    {
        $role = $this->roleService->storeRole($request->validated());

        return response()->json([
            'role' => new RoleResource($role),
            'message' => 'Role created successfully'
        ], 201);
    }
}
