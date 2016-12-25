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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/leaves', 'LeavesController@getIndex');
Route::get('/leaves/apply', 'LeavesController@getApply');

// Settings
Route::get('/settings/teams', 'Settings\TeamsController@getIndex');
Route::get('/settings/teams/add', 'Settings\TeamsController@getAdd');
Route::post('/settings/teams/add', 'Settings\TeamsController@postAdd');
Route::get('/settings/teams/edit/{id}', 'Settings\TeamsController@getEdit');
Route::post('/settings/teams/edit/{id}', 'Settings\TeamsController@postEdit');
Route::get('/ajax/teams/manage/manager', 'Settings\TeamsController@ajaxGetAddManager');

Route::get('/settings/departments', 'Settings\DepartmentsController@getIndex');
Route::get('/settings/departments/add', 'Settings\DepartmentsController@getAdd');
Route::post('/settings/departments/add', 'Settings\DepartmentsController@postAdd');
Route::get('/settings/departments/edit/{id}', 'Settings\DepartmentsController@getEdit');
Route::post('/settings/departments/edit/{id}', 'Settings\DepartmentsController@postEdit');

Route::get('/settings/employees', 'Settings\EmployeesController@getIndex');
Route::get('/settings/employees/add', 'Settings\EmployeesController@getAdd');
Route::post('/settings/employees/add', 'Settings\EmployeesController@postAdd');
Route::get('/settings/employees/edit/{id}', 'Settings\EmployeesController@getEdit');
Route::post('/settings/employees/edit/{id}', 'Settings\EmployeesController@postEdit');
Route::get('/ajax/employees/search', 'Settings\EmployeesController@ajaxGetEmployeeSearch');
