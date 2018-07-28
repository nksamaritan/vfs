<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return Redirect::to('login');
});

Auth::routes();
Route::get('after_reset_password', ['uses' => 'Api\LoginController@afterResetPassword']);
Route::get('/maintanance', function (){
    return view('maintanance');
});

/*
 *  Dashboard Management
 *  get file from resources/views
 * */

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);


/*
 *  Role Management
 *  get files from resources/views/role
 * */

Route::group(array('prefix' => 'role','Permission'=>"role_manage", 'as' => 'role::'), function() {
    Route::any('list', ['as' => 'indexRole', 'uses' => 'RoleController@index']);
    Route::get('add', ['as' => 'createRole', 'uses' => 'RoleController@create']);
    Route::get('edit/{id}', ['as' => 'editRole', 'uses' => 'RoleController@edit']);
    Route::post('store', ['as' => 'storeRole', 'uses' => 'RoleController@store']);
    Route::post('update', ['as' => 'updateRole', 'uses' => 'RoleController@update']);
});

/*
 *  Permission Management
 *  get files from resources/views/permission
 * */

Route::group(array('prefix' => 'permission','Permission'=>"permission_management", 'as' => 'permission::'), function() {
    Route::any('list', ['as' => 'indexPermission', 'uses' => 'PermissionController@index']);
    Route::get('add', ['as' => 'createPermission', 'uses' => 'PermissionController@create']);
    Route::get('edit/{id}', ['as' => 'editPermission', 'uses' => 'PermissionController@edit']);
    Route::post('store', ['as' => 'storePermission', 'uses' => 'PermissionController@store']);
    Route::post('update', ['as' => 'updatePermission', 'uses' => 'PermissionController@update']);
});

/*
 *  User Management
 *  get files from resources/views/permission
 * */
Route::get('/change-password', ['uses' => 'UserController@changePassword']);
Route::post('/update_password', ['uses' => 'UserController@updatePassword']);
Route::group(array('prefix' => 'user','Permission'=>"user_management", 'as' => 'user::'), function() {
    Route::any('list', ['as' => 'indexUser', 'uses' => 'UserController@index']);
    Route::get('add', ['as' => 'createUser', 'uses' => 'UserController@create']);
    Route::get('profile', ['uses' => 'UserController@profile']);
    Route::get('edit/{id}', ['as' => 'editUser', 'uses' => 'UserController@edit']);
    Route::post('delete', ['as' => 'deleteUser', 'uses' => 'UserController@delete']);
    Route::post('store', ['as' => 'storeUser', 'uses' => 'UserController@store']);
    Route::post('update', ['as' => 'updateUser', 'uses' => 'UserController@update']);
    Route::post('change_status', ['uses' => 'UserController@changeStatus']);
    Route::post('datatable', ['uses' => 'UserController@datatable']);
});


