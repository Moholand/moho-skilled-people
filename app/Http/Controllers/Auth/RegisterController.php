<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Auth\UserRegisterRequest;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $request->country_id
        ]);

        return response()->json([
            'user' => new UserResource($user),
            'message' => 'User registered successfully'
        ]);
    }
}
