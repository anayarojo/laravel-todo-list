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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@authenticate');

Route::group(['prefix' => 'validate'], function (){
    Route::get('/email/{email}', 'ValidatorController@isEmailAvailable');
});

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user', 'AuthController@getAuthenticatedUser');

    Route::apiResource('users', 'UserController');
    Route::apiResource('roles', 'RoleController');

    Route::group(['prefix' => 'users/{user}/roles/{role}'], function (){
        Route::put('add', 'UserRoleController@add');
        Route::put('quit', 'UserRoleController@quit');
    });

    Route::group(['prefix' => 'categories'], function (){
        Route::get('/', 'GroupController@index');
        Route::post('/', 'GroupController@store');
        Route::get('/{category}', 'GroupController@show');
        Route::put('/{category}', 'GroupController@update');
        Route::delete('/{category}', 'GroupController@destroy');
    });

    Route::group(['prefix' => 'lists'], function (){
        Route::get('/{category?}', 'GroupController@index');
        Route::post('/{category?}', 'GroupController@store');
        Route::get('/{list}', 'GroupController@show');
        Route::put('/{list}', 'GroupController@update');
        Route::delete('/{list}', 'GroupController@destroy');

        Route::group(['prefix' => '{list}'], function (){
            Route::apiResource('tasks', 'TaskController');
        });
    });
});