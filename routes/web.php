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

// Perks - Gift Certificates
Route::get('/perks/gift-certificates', 'Perks\GiftCertificatesController@getIndex');
Route::post('/perks/gift-certificates/{id}', 'Perks\GiftCertificatesController@postIndex')->where('id', '[0-9]+');

// Perks - Gift Certificates Distribution
Route::get('/perks/gift-certificates/distribution', 'Perks\GiftCertificatesController@getDistribution');
Route::post('/perks/gift-certificates/distribution', 'Perks\GiftCertificatesController@postDistribution');
Route::put('/ajax/perks/gift-certificates/redeem', 'Perks\GiftCertificatesController@putRedeemGiftCertificate');
Route::get('/ajax/perks/gift-certificates/reports', 'Perks\GiftCertificatesController@ajaxGetGiftCertificateReport');


// Perks - Food Stubs
Route::get('/perks/foodstubs', 'Perks\FoodStubsController@getIndex');

// Settings - Teams
Route::get('/settings/teams', 'Settings\TeamsController@getIndex');
Route::get('/settings/teams/add', 'Settings\TeamsController@getAdd');
Route::post('/settings/teams/add', 'Settings\TeamsController@postAdd');
Route::get('/settings/teams/edit/{id}', 'Settings\TeamsController@getEdit')->where('id', '[0-9]+');
Route::post('/settings/teams/edit/{id}', 'Settings\TeamsController@postEdit')->where('id', '[0-9]+');
Route::put('/ajax/settings/teams/manager', 'Settings\TeamsController@ajaxPutTeamManager');
Route::delete('/ajax/settings/teams/manager', 'Settings\TeamsController@ajaxDeleteTeamManager');
Route::put('/ajax/settings/teams/member', 'Settings\TeamsController@ajaxPutTeamMember');
Route::delete('/ajax/settings/teams/member', 'Settings\TeamsController@ajaxDeleteTeamMember');
Route::delete('/ajax/settings/teams', 'Settings\TeamsController@ajaxDeleteTeam');

// Settings - Departments
Route::get('/settings/departments', 'Settings\DepartmentsController@getIndex');
Route::get('/settings/departments/add', 'Settings\DepartmentsController@getAdd');
Route::post('/settings/departments/add', 'Settings\DepartmentsController@postAdd');
Route::get('/settings/departments/edit/{id}', 'Settings\DepartmentsController@getEdit')->where('id', '[0-9]+');
Route::post('/settings/departments/edit/{id}', 'Settings\DepartmentsController@postEdit')->where('id', '[0-9]+');
Route::delete('/ajax/settings/departments/', 'Settings\DepartmentsController@ajaxDeleteDepartment');

// Settings - Employees
Route::get('/settings/employees', 'Settings\EmployeesController@getIndex');
Route::get('/settings/employees/add', 'Settings\EmployeesController@getAdd');
Route::post('/settings/employees/add', 'Settings\EmployeesController@postAdd');
Route::get('/settings/employees/edit/{id}', 'Settings\EmployeesController@getEdit')->where('id', '[0-9]+');
Route::post('/settings/employees/edit/{id}', 'Settings\EmployeesController@postEdit')->where('id', '[0-9]+');
Route::get('/ajax/settings/employees/search', 'Settings\EmployeesController@ajaxGetEmployeeSearch');
Route::delete('/ajax/settings/employees', 'Settings\EmployeesController@ajaxDeleteEmployee');

// Settings - Leave Templates
Route::get('/settings/leave-templates', 'Settings\LeaveTemplatesController@getIndex');
Route::get('/settings/leave-templates/add', 'Settings\LeaveTemplatesController@getAdd');
Route::post('/settings/leave-templates/add', 'Settings\LeaveTemplatesController@postAdd');
Route::get('/settings/leave-templates/edit/{id}', 'Settings\LeaveTemplatesController@getEdit')->where('id', '[0-9]+');
Route::post('/settings/leave-templates/edit/{id}', 'Settings\LeaveTemplatesController@postEdit')->where('id', '[0-9]+');
Route::delete('/ajax/settings/leave-templates', 'Settings\LeaveTemplatesController@ajaxDeleteLeaveTemplate');