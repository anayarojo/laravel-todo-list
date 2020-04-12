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
        Route::get('/', 'CategoryController@index');
        Route::post('/', 'CategoryController@store');
        Route::get('/{category}', 'CategoryController@show');
        Route::put('/{category}', 'CategoryController@update');
        Route::delete('/{category}', 'CategoryController@destroy');
    });

    Route::group(['prefix' => 'lists'], function (){
        Route::get('/{category?}', 'ListController@index');
        Route::post('/{category?}', 'ListController@store');
        Route::get('/{list}', 'ListController@show');
        Route::put('/{list}', 'ListController@update');
        Route::delete('/{list}', 'ListController@destroy');
    });

    Route::group(['prefix' => 'tasks'], function (){
        Route::get('/{list?}', 'TaskController@index');
        Route::post('/{list?}', 'TaskController@store');
        Route::get('/{task}', 'TaskController@show');
        Route::put('/{task}', 'TaskController@update');
        Route::delete('/{task}', 'TaskController@destroy');
    });
});