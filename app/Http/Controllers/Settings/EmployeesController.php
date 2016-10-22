<?php
namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Department;
use App\Team;

class EmployeesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data = [];
        $departmentModel = new Department;
        $departments = $departmentModel::all();

        $data['departments'] = $departments;

        return view('settings.employees.index', ['data' => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $data = [];
        $departmentModel = new Department;
        $departments = $departmentModel::all();
        $data['departments'] = $departments;

        $teamModel = new Team;
        $teams = $teamModel::all();
        $data['teams'] = $teams;

        return view('settings.employees.add', ['data' => $data]);
    }

    /**
     *
     */
    public function postAdd(Request $request)
    {
        // Employee Information
        $employeeId = $request->input('employee_id');
        $employeeFirstName = $request->input('employee_firstname');
        $employeeMiddleName = $request->input('employee_middlename');
        $employeeLastName = $request->input('employee_lastname');
        $employeeGender = $request->input('employee_gender');
        $employeeMaritalStatus = $request->input('employee_marital_status');
        $employeeBirthday = $request->input('employee_birthday');
        $employeeStatus = $request->input('employee_status');
        $employeeDateHired = $request->input('employee_date_hired');
        $employeeDateRegularized = $request->input('employee_date_regularized');
        $employeeDepartment = $request->input('employee_department');
        $employeeTeam = $request->input('employee_team');

        dd($request->all());

    }
}