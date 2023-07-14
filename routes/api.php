<?php

use Domain\Authentication\HttpApi\Controllers\CheckAuthController;
use Domain\Authentication\HttpApi\Controllers\LogoutController;
use Domain\Authentication\HttpApi\Controllers\LoginController;
use Domain\Task\HttpApi\Controllers\BoardController;
use Domain\Task\HttpApi\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', LogoutController::class);

    Route::apiResource('boards', BoardController::class)
        ->only('index');

    Route::put('boards/{board}/sync-and-reorder-tasks', [BoardController::class, 'syncTaskAndReorder']);

    Route::apiResource('tasks', TaskController::class)
        ->only('store', 'update', 'destroy');
});

Route::middleware('guest')->group(function () {
    Route::post('login', LoginController::class);
});

Route::get('check-auth', CheckAuthController::class);
