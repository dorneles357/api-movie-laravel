<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\TagController;


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

/*MOVIE CRUD*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'movies',
    'namespace' => 'App\Http\Controllers\Api'
], function($router){
    Route::post('/create', [MovieController::class, 'store']);
    Route::get('/index', [MovieController::class, 'index']);
    Route::get('/index/orderby/asc', [MovieController::class, 'orderbyASC']);
    Route::get('/index/orderby/desc', [MovieController::class, 'orderbyDESC']);
    Route::get('/{id}', [MovieController::class, 'show']);
    Route::put('/update/{id}', [MovieController::class, 'update']);
    Route::delete('/delete/{id}', [MovieController::class, 'destroy']);
});

/*TAGS*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'tags',
    'namespace' => 'App\Http\Controllers\Api'
], function($router){
    Route::post('/create/{id}', [TagController::class, 'store']);
    Route::delete('/delete/{id}', [TagController::class, 'destroy']);
});








/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */