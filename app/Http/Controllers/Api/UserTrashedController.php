<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;

class UserTrashedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return UserResource::collection(
            User::with(['country', 'skills'])->onlyTrashed()->paginate(20)->withQueryString()
        );
    }
}
