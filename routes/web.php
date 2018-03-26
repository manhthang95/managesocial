<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login.html');
});

Route::get('/login.html','ManageLoginController@login');
Route::post('/login-action.html','ManageLoginController@loginAction');
Route::get('/logout-action.html','ManageLoginController@logout');
Route::get('/my-profile.html','ManageLoginController@myProfile');
Route::post('/my-profile/edit-profile-action.html','ManageLoginController@editMyProfileAction');
Route::get('/welcome.html','HomeController@default_dasboard');

//ManageUserController	
Route::get('/manage-user.html','ManageUserController@viewAll');
Route::get('manage-user/add-user.html','ManageUserController@addUser');
Route::post('manage-user/add-user-action.html','ManageUserController@addUserAction');
Route::get('/manage-user/edit-user/{id}.html','ManageUserController@editUser');
Route::post('/manage-user/edit-user-action/{id}.html','ManageUserController@editUserAction');
Route::get('manage-user/delete-user/{id}.html','ManageUserController@deleteUser');

//ManageUserLogsController
Route::get('/manage-user-logs.html','ManageUserLogsController@viewAll');
Route::get('/manage-user-logs/detail-user-logs/{id}.html','ManageUserLogsController@detailUserLogs');
