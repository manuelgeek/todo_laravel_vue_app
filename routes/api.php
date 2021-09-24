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

        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::get('/profile', 'AuthController@profile');
            Route::post('update/password', 'ResetPasswordController@updatePassword');
            Route::post('/logout', 'AuthController@logout');
        });
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // get user tasks and categories
        Route::apiResource('categories', 'CategoriesController')->parameters(['categories' => 'category:slug']);
        Route::apiResource('tasks', 'TasksController')->parameters(['tasks' => 'task:slug']);
        Route::get('search/tasks', 'TasksController@search');
        Route::get('user/{user}/tasks', 'TasksController@userTasks');
        Route::get('/tasks/{task:slug}/comments', 'TasksController@indexComment');
        Route::post('/tasks/{task:slug}/comments', 'TasksController@storeComment');
        Route::put('/tasks/{task:slug}/status', 'TasksController@updateStatus');
        Route::get('/tasks/{task:slug}/visibility', 'TasksController@updateVisibility');
        Route::delete('/tasks/{task:slug}/comments/{comment}', 'TasksController@destroyComment');
    });
});
