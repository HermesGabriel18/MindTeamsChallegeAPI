<?php

use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');

    /**
     * Assignments
     */
    Route::apiResource('assignments', AssignmentController::class)->except(['update']);

    /**
     * Clients
     */
    Route::apiResource('clients', ClientController::class);

    /**
     * Projects
     */
    Route::apiResource('projects', ProjectController::class);

    /**
     * Roles
     */
    Route::apiResource('roles', RoleController::class)->only(['index']);

    /**
     * Users
     */
    Route::get('users/me', [LoginController::class, 'me'])->name('users.me');
    Route::apiResource('users', UserController::class);

});

