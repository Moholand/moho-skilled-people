<?php

use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\EmployerController;
use App\Http\Controllers\Api\UserEmployerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\UserRoleController;

Route::group(['prefix' => 'auth'], function () {
  Route::post('login', [AuthController::class, 'login']);
  Route::post('register', [RegisterController::class, 'register']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::post('me', [AuthController::class, 'me']);
});

/** users register route */
Route::post('users', [UserController::class, 'store'])->name('users.store');

Route::group(['middleware' => 'auth:api'], function () {

  /** users routes */
  Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
  Route::get('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
  Route::apiResource('users', UserController::class)->except('store');

  /** roles routes */
  Route::apiResource('roles', RoleController::class)->only(['index', 'store']);

  /** user roles routes */
  Route::apiResource('users.roles', UserRoleController::class)->only(['store', 'destroy']);

  /** candidates routes */
  Route::apiResource('candidates', CandidateController::class)->only(['index', 'update', 'destroy']);

  /** employers routes */
  Route::apiResource('employers', EmployerController::class);

  /** users employers routes */
  Route::apiResource('users.employers', UserEmployerController::class);
});
