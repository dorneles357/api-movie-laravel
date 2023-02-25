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
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});

/*USERS*/
Route::group([
    'middleware' => 'api.auth',
    'prefix' => 'users',
    'namespace' => 'App\Http\Controllers\Api'
], function ($router) {
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/update/{id}', [UserController::class, 'update']);
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);
});

/*MOVIE CRUD*/
Route::group([
    'middleware' => 'api.auth',
    'prefix' => 'movies',
    'namespace' => 'App\Http\Controllers\Api'
], function ($router) {
    Route::post('/create', [MovieController::class, 'store']);
    Route::get('/index', [MovieController::class, 'index']);
    Route::get('/index/orderby/asc', [MovieController::class, 'orderbyASC']);
    Route::get('/index/orderby/desc', [MovieController::class, 'orderbyDESC']);
    Route::get('/{id}', [MovieController::class, 'show']);
    Route::put('/update/{id}', [MovieController::class, 'update']);
    Route::delete('/delete/{id}', [MovieController::class, 'destroy']);
    Route::post('/assign/tags', [MovieController::class, 'assignTags']);

    Route::post('/', [MovieController::class, 'store']);
    Route::get('/', [MovieController::class, 'index']);
    Route::get('/{movie_id}', [MovieController::class, 'show']);
    Route::put('/{movie_id}', [MovieController::class, 'update']);
    Route::delete('/{movie_id}', [MovieController::class, 'destroy']);


    Route::post('/assign/tags', [MovieController::class, 'assignTags']);
});

/*TAGS*/
Route::group([
    'middleware' => 'api.auth',
    'prefix' => 'tags',
    'namespace' => 'App\Http\Controllers\Api'
], function ($router) {
    Route::post('/create', [TagController::class, 'store']);
    Route::delete('/delete/{id}', [TagController::class, 'destroy']);
});





Route::get('/', function () {
    return response()->json([
        'message' => "Welcome! Brow! 🥳",
        'Register' => "http://localhost:8180/api/auth/register",
        'Login' => "http://localhost:8180/api/auth/login"
    ]);
});
