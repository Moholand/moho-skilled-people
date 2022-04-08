<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAll();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update([
            'english_full_name' => $request->english_full_name,
            'persian_full_name' => $request->persian_full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $request->country_id,
        ]);

        return response()->json([
            'user' => new UserResource($user),
            'message' => 'User updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if($user->trashed()) {
            $user->forceDelete();
            return response()->json(['message' => 'User deleted successfully']);
        } else {
            $user->delete();
            return response()->json(['message' => 'User moved to trashed successfully']);
        }
    }
}
