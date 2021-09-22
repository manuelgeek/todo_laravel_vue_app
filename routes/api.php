<?php

use Illuminate\Http\Request;
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

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});

Route::group(['namespace' => 'API', 'prefix' => 'v1'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        // passwords
        Route::post('password/email', 'ResetPasswordController@forgot');
        Route::post('password/reset', 'ResetPasswordController@reset');
        Route::post('update/reset', 'ResetPasswordController@updatePassword');

        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::post('/profile', 'AuthController@profile');
            Route::post('/logout', 'AuthController@logout');
        });
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('categories', 'CategoriesController')->parameters(['categories' => 'category:slug']);
        Route::apiResource('tasks', 'TasksController')->parameters(['tasks' => 'task:slug']);
        Route::get('user/{user}/tasks', 'TasksController@userTasks');
    });
});
