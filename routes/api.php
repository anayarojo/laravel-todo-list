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

    Route::group(['prefix' => 'lists'], function (){

        Route::get('/{parent?}', 'GroupController@index');
        Route::post('/{parent?}', 'GroupController@store');
        Route::get('/{group}', 'GroupController@show');
        Route::put('/{group}', 'GroupController@update');
        Route::delete('/{group}', 'GroupController@destroy');

        Route::group(['prefix' => '{group}'], function (){
            Route::apiResource('tasks', 'TaskController');
        });

    });
});
