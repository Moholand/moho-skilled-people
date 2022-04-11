<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use App\Services\RoleService;

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
}
