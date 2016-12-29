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

// Settings - Teams
Route::get('/settings/teams', 'Settings\TeamsController@getIndex');
Route::get('/settings/teams/add', 'Settings\TeamsController@getAdd');
Route::post('/settings/teams/add', 'Settings\TeamsController@postAdd');
Route::get('/settings/teams/edit/{id}', 'Settings\TeamsController@getEdit');
Route::post('/settings/teams/edit/{id}', 'Settings\TeamsController@postEdit');
Route::put('/ajax/settings/teams/manager', 'Settings\TeamsController@ajaxPutTeamManager');
Route::delete('/ajax/settings/teams/manager', 'Settings\TeamsController@ajaxDeleteTeamManager');
Route::delete('/ajax/settings/teams', 'Settings\TeamsController@ajaxDeleteTeam');

// Settings - Departments
Route::get('/settings/departments', 'Settings\DepartmentsController@getIndex');
Route::get('/settings/departments/add', 'Settings\DepartmentsController@getAdd');
Route::post('/settings/departments/add', 'Settings\DepartmentsController@postAdd');
Route::get('/settings/departments/edit/{id}', 'Settings\DepartmentsController@getEdit');
Route::post('/settings/departments/edit/{id}', 'Settings\DepartmentsController@postEdit');
Route::delete('/ajax/settings/departments/', 'Settings\DepartmentsController@ajaxDeleteDepartment');

// Settings - Employees
Route::get('/settings/employees', 'Settings\EmployeesController@getIndex');
Route::get('/settings/employees/add', 'Settings\EmployeesController@getAdd');
Route::post('/settings/employees/add', 'Settings\EmployeesController@postAdd');
Route::get('/settings/employees/edit/{id}', 'Settings\EmployeesController@getEdit');
Route::post('/settings/employees/edit/{id}', 'Settings\EmployeesController@postEdit');
Route::get('/ajax/settings/employees/search', 'Settings\EmployeesController@ajaxGetEmployeeSearch');
Route::delete('/ajax/settings/employees', 'Settings\EmployeesController@ajaxDeleteEmployee');

// Settings - Leave Templates
Route::get('/settings/leave-templates', 'Settings\LeaveTemplatesController@getIndex');
Route::get('/settings/leave-templates/add', 'Settings\LeaveTemplatesController@getAdd');