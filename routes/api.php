<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

Route::group(['prefix' => 'auth'], function () {
  Route::post('login', [AuthController::class, 'login']);
  Route::post('register', [RegisterController::class, 'register']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth:api'], function () {

  /** users routes */
  Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
  Route::get('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
  Route::apiResource('users', UserController::class);

  /** roles routes */
  Route::apiResource('roles', RoleController::class)->only(['index', 'store']);

});
