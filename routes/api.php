<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\UserRestoreController;
use App\Http\Controllers\Api\UserTrashedController;

Route::group(['prefix' => 'auth'], function () {
  Route::post('login', [AuthController::class, 'login']);
  Route::post('register', [RegisterController::class, 'register']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth:api'], function () {
  Route::apiResource('users', UserController::class);
  Route::get('trashed-users', UserTrashedController::class)->name('users.trashed');
  Route::get('users/{user}/restore', UserRestoreController::class)->name('users.restore');
});
