<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GreetingController;
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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('greetings/received', [GreetingController::class, 'received'])->middleware('auth:sanctum');
Route::get('sent', [GreetingController::class, 'sent'])->middleware('auth:sanctum');
Route::apiResource('greetings', GreetingController::class)->middleware('auth:sanctum');
