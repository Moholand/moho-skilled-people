<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRestoreController;
use App\Http\Controllers\Api\UserTrashedController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('users', UserController::class);
Route::get('trashed-users', UserTrashedController::class)->name('users.trashed');
Route::get('users/{user}/restore', UserRestoreController::class)->name('users.trashed');
