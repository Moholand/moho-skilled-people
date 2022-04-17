<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * @var UserService $userService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param  UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = $this->userService->allUsers();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->storeUser($request->validated());

        return response()->json([
            'user' => new UserResource($user),
            'message' => 'User created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $user = $this->userService->getUser($user->id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user = $this->userService->updateUser($request->validated(), $user->id);

        return response()->json([
            'user' => new UserResource($user),
            'message' => 'User updated successfully'
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
        $user = $this->userService->getUserWithTrashed($id);

        $this->authorize('delete', $user);

        $result = $this->userService->deleteUser($id);

        return response()->json(['message' => $result]);
    }

    /**
     *  Restore user data
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $this->authorize('restore', User::class);

        $this->userService->restoreUser($id);

        return response()->json(['message' => 'User restored successfully']);
    }

    /**
     * Display a listing of the trashed users.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function trashed()
    {
        $this->authorize('trashed', User::class);

        $users = $this->userService->trashedUsers();

        return UserResource::collection($users);
    }
}
