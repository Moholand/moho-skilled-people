<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserRestoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        return response()->json(['message' => 'User restored successfully']);
    }
}
