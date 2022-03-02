<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

/*AUTH*/
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Api'

], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController:: class, 'login']);
    Route::post('/logout', [AuthController:: class, 'logout']);
    Route::post('/refresh', [AuthController:: class, 'refresh']);
    Route::post('/me', [AuthController:: class, 'me']);

});

/*USERS*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'users',
    'namespace' => 'App\Http\Controllers\Api'
], function($router){
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/update/{id}', [UserController::class, 'update']);
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);
});







/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */