<?php

use Illuminate\Http\Request;

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

Route::group(array('prefix' => 'v1'), function() {
    Route::post('login', ['uses' => 'Api\LoginController@login']);
    Route::post('forgot_password', ['uses' => 'Api\LoginController@sendResetLinkEmail']);
    Route::group(array('middleware' => ['auth:api']), function() {
        Route::post('update_password', ['uses' => 'Api\LoginController@updatePassword']);
    });
});
