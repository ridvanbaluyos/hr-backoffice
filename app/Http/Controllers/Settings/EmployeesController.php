<?php
namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Department;
use App\Team;
use App\EmployeeInformation;
use App\AccountInformation;
use App\GovernmentNumber;
use App\SalaryInformation;

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
        $departmentModel = new Department();
        $departments = $departmentModel::all()->keyBy('id')->toArray();
        $data['departments'] = $departments;

        $teamModel = new Team();
        $teams = $teamModel::all()->keyBy('id')->toArray();
        $data['teams'] = $teams;

        $employeeInformationModel = new EmployeeInformation();
        $employeeInformation = $employeeInformationModel::paginate(15);

        $data['employees'] = $employeeInformation;

        return view('settings.employees.index', ['data' => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $data = [];
        $departmentModel = new Department;
        $departments = $departmentModel::all()->toArray();
        $data['departments'] = $departments;

        $teamModel = new Team;
        $teams = $teamModel::all()->toArray();
        $data['teams'] = $teams;

        $data['gender'] = config('formvalues.gender');
        $data['marital_status'] = config('formvalues.marital_status');
        $data['employee_status'] = config('formvalues.employee_status');
        $data['backoffice_roles'] = config('formvalues.backoffice_roles');
        $data['tax_status'] = config('formvalues.tax_status');
        $data['withholding_tax'] = config('formvalues.withholding_tax');

        return view('settings.employees.add', ['data' => $data]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdd(Request $request)
    {
        // Employee Information
        $employeeNumber = $request->input('employee_number');
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
        $createdBy = Auth::user()->email;

        // Account Information
        $accountUsername = $request->input('account_username');
        $accountPassword = $request->input('account_password');
        $accountEmail = $request->input('account_email');
        $accountRole = $request->input('account_role');
        $accountBiometricsId = $request->input('account_biometrics_id');

        // Government Numbers
        $governmentNumberTin = $request->input('government_number_tin');
        $governmentNumberPhilhealth = $request->input('government_number_philhealth');
        $governmentNumberPagibig = $request->input('government_number_pagibig');
        $governmentNumberSss = $request->input('government_number_sss');
        $governmentNumberTaxStatus = $request->input('government_number_tax_status');
        $governmentNumberWithholdingTax= $request->input('government_number_withholding_tax');
        $governmentNumberPhilhealthEffectivityDate = $request->input('government_number_philhealth_effectivity_date');
        $governmentNumberPagibigContribution = $request->input('government_number_pagibig_contribution');

        // Salary Information
        $salaryOtApplicable = $request->input('salary_ot_applicable');
        $salaryLateApplicable = $request->input('salary_late_applicable');
        $salaryUndertimeApplicable = $request->input('salary_undertime_applicable');
        $salaryNightDiffApplicable = $request->input('salary_night_diff_applicable');
        $salaryHolidayApplicable = $request->input('salary_holiday_applicable');
//        $salaryPayrollGroup = $request->input('salary_payroll_group');
        $salaryExcludeFromPayroll = $request->input('salary_exclude_from_payroll');
        $salaryExcludeFromTar = $request->input('salary_exclude_from_tar');
        $salaryHasSss = $request->input('salary_has_sss');
        $salaryHasWithholdingTax = $request->input('salary_has_withholding_tax');
        $salaryHasPhilhealth = $request->input('salary_has_philhealth');
        $salaryHasPagibig = $request->input('salary_has_pagibig');
        $salaryWithPreviousEmployer = $request->input('salary_with_previous_employer');

        try {
            // Employee Information
            $employeeInformationModel = new EmployeeInformation();
            $employeeInformationModel->employee_number = $employeeNumber;
            $employeeInformationModel->last_name = $employeeLastName;
            $employeeInformationModel->first_name = $employeeFirstName;
            $employeeInformationModel->middle_name = $employeeMiddleName;
            $employeeInformationModel->gender = $employeeGender;
            $employeeInformationModel->marital_status = $employeeMaritalStatus;
            $employeeInformationModel->birthdate = date("Y-m-d", strtotime($employeeBirthday));
            $employeeInformationModel->employee_status = $employeeStatus;
            $employeeInformationModel->date_hired = date("Y-m-d", strtotime($employeeDateHired));
            $employeeInformationModel->date_regularized = date("Y-m-d", strtotime($employeeDateRegularized));
            $employeeInformationModel->department_id = $employeeDepartment;
            $employeeInformationModel->team_id = $employeeTeam;
            $employeeInformationModel->created_by = $createdBy;
            $employeeInformationModel->save();

            // Account Information
            $accountInformationModel = new AccountInformation();
            $accountInformationModel->user_id = $employeeInformationModel->id;
            $accountInformationModel->username = $accountUsername;
            $accountInformationModel->password = $accountPassword;
            $accountInformationModel->email = $accountEmail;
            $accountInformationModel->role = $accountRole;
            $accountInformationModel->biometrics_id = $accountBiometricsId;
            $accountInformationModel->created_by = $createdBy;
            $accountInformationModel->save();

            // Government Numbers
            $governmentNumberModel = new GovernmentNumber();
            $governmentNumberModel->user_id = $employeeInformationModel->id;
            $governmentNumberModel->tin = $governmentNumberTin;
            $governmentNumberModel->philhealth = $governmentNumberPhilhealth;
            $governmentNumberModel->pagibig = $governmentNumberPagibig;
            $governmentNumberModel->sss= $governmentNumberSss;
            $governmentNumberModel->tax_status = $governmentNumberTaxStatus;
            $governmentNumberModel->withholding_tax = $governmentNumberWithholdingTax;
            $governmentNumberModel->philhealth_effectivity_date = $governmentNumberPhilhealthEffectivityDate;
            $governmentNumberModel->pagibig_contribution = $governmentNumberPagibigContribution;
            $governmentNumberModel->created_by = $createdBy;
            $governmentNumberModel->save();

            // Salary Information
            $salaryInformationModel = new SalaryInformation();
            $salaryInformationModel->user_id = $employeeInformationModel->id;
            $salaryInformationModel->ot_applicable = $salaryOtApplicable;
            $salaryInformationModel->late_applicable = $salaryLateApplicable;
            $salaryInformationModel->undertime_applicable = $salaryUndertimeApplicable;
            $salaryInformationModel->night_diff_applicable = $salaryNightDiffApplicable;
            $salaryInformationModel->holiday_applicable = $salaryHolidayApplicable;
            $salaryInformationModel->has_sss = $salaryHasSss;
            $salaryInformationModel->has_withholding_tax = $salaryHasWithholdingTax;
            $salaryInformationModel->has_philhealth = $salaryHasPhilhealth;
            $salaryInformationModel->has_pagibig = $salaryHasPagibig;
            $salaryInformationModel->with_previous_employer = $salaryWithPreviousEmployer;
            $salaryInformationModel->exclude_from_payroll = $salaryExcludeFromPayroll;
            $salaryInformationModel->exclude_from_tar = $salaryExcludeFromTar;
            $salaryInformationModel->created_by = $createdBy;
            $salaryInformationModel->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', 'Employee #: ' . $employeeNumber . ' has been successfully added!');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            switch ($e->getCode()) {
                case '23000':
                    $message = 'Employee #: ' . $employeeNumber . ' already exists.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/employees');
    }

    public function getEdit($id)
    {
        $employeeModel = new EmployeeInformation();
        $employee = $employeeModel->find($id);
        $data['employee'] = $employee;

        $accountModel = new AccountInformation();
        $account = $accountModel->where('user_id', $id)->get();
        $data['account'] = $account[0];

        $governmentNumberModel = new GovernmentNumber();
        $governmentNumber = $governmentNumberModel->where('user_id', $id)->get();
        $data['government_number'] = $governmentNumber[0];

        $departmentModel = new Department();
        $departments = $departmentModel::all()->toArray();
        $data['departments'] = $departments;

        $teamModel = new Team();
        $teams = $teamModel::all()->toArray();
        $data['teams'] = $teams;

        $salaryModel = new SalaryInformation();
        $salary = $salaryModel->where('user_id', $id)->get();
        $data['salary'] = $salary[0];

        $data['gender'] = config('formvalues.gender');
        $data['marital_status'] = config('formvalues.marital_status');
        $data['employee_status'] = config('formvalues.employee_status');
        $data['backoffice_roles'] = config('formvalues.backoffice_roles');
        $data['tax_status'] = config('formvalues.tax_status');
        $data['withholding_tax'] = config('formvalues.withholding_tax');

        return view('settings.employees.add', ['data' => $data]);
    }

    public function postEdit(Request $request, $id)
    {
        // Employee Information
        $employeeNumber = $request->input('employee_number');
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

        // Account Information
        $accountUsername = $request->input('account_username');
        $accountPassword = $request->input('account_password');
        $accountEmail = $request->input('account_email');
        $accountRole = $request->input('account_role');
        $accountBiometricsId = $request->input('account_biometrics_id');

        // Government Numbers
        $governmentNumberTin = $request->input('government_number_tin');
        $governmentNumberPhilhealth = $request->input('government_number_philhealth');
        $governmentNumberPagibig = $request->input('government_number_pagibig');
        $governmentNumberSss = $request->input('government_number_sss');
        $governmentNumberTaxStatus = $request->input('government_number_tax_status');
        $governmentNumberWithholdingTax= $request->input('government_number_withholding_tax');

        // Salary Information
        $salaryOtApplicable = $request->input('salary_ot_applicable');
        $salaryLateApplicable = $request->input('salary_late_applicable');
        $salaryUndertimeApplicable = $request->input('salary_undertime_applicable');
        $salaryNightDiffApplicable = $request->input('salary_night_diff_applicable');
        $salaryHolidayApplicable = $request->input('salary_holiday_applicable');
//        $salaryPayrollGroup = $request->input('salary_payroll_group');
        $salaryExcludeFromPayroll = $request->input('salary_exclude_from_payroll');
        $salaryExcludeFromTar = $request->input('salary_exclude_from_tar');
        $salaryHasSss = $request->input('salary_has_sss');
        $salaryHasWithholdingTax = $request->input('salary_has_withholding_tax');
        $salaryHasPhilhealth = $request->input('salary_has_philhealth');
        $salaryHasPagibig = $request->input('salary_has_pagibig');
        $salaryWithPreviousEmployer = $request->input('salary_with_previous_employer');

        try {
            // Employee Information
            $employeeInformationModel = new EmployeeInformation();
            $employee = $employeeInformationModel->find($id);
            $employee->last_name = $employeeLastName;
            $employee->first_name = $employeeFirstName;
            $employee->middle_name = $employeeMiddleName;
            $employee->gender = $employeeGender;
            $employee->marital_status = $employeeMaritalStatus;
            $employee->birthdate = date("Y-m-d", strtotime($employeeBirthday));
            $employee->employee_status = $employeeStatus;
            $employee->date_hired = date("Y-m-d", strtotime($employeeDateHired));
            $employee->date_regularized = date("Y-m-d", strtotime($employeeDateRegularized));
            $employee->department_id = $employeeDepartment;
            $employee->team_id = $employeeTeam;
            $employee->save();

            // Account Information
            $accountInformationModel = new AccountInformation();
            $account = $accountInformationModel->where('user_id', $id)->first();
            $account->user_id = $id;
            $account->username = $accountUsername;
            $account->password = $accountPassword;
            $account->email = $accountEmail;
            $account->role = $accountRole;
            $account->biometrics_id = $accountBiometricsId;
            $account->save();

            // Government Numbers
            $governmentNumberModel = new GovernmentNumber();
            $governmentNumber = $governmentNumberModel->where('user_id', $id)->first();
            $governmentNumber->user_id = $id;
            $governmentNumber->tin = $governmentNumberTin;
            $governmentNumber->philhealth = $governmentNumberPhilhealth;
            $governmentNumber->pagibig = $governmentNumberPagibig;
            $governmentNumber->sss = $governmentNumberSss;
            $governmentNumber->tax_status = $governmentNumberTaxStatus;
            $governmentNumber->withholding_tax = $governmentNumberWithholdingTax;
            $governmentNumber->save();

            // Salary Information
            $salaryInformationModel = new SalaryInformation();
            $salaryInformationModel = $salaryInformationModel->where('user_id', $id)->first();
            $salaryInformationModel->user_id = $id;
            $salaryInformationModel->ot_applicable = $salaryOtApplicable;
            $salaryInformationModel->late_applicable = $salaryLateApplicable;
            $salaryInformationModel->undertime_applicable = $salaryUndertimeApplicable;
            $salaryInformationModel->night_diff_applicable = $salaryNightDiffApplicable;
            $salaryInformationModel->holiday_applicable = $salaryHolidayApplicable;
            $salaryInformationModel->has_sss = $salaryHasSss;
            $salaryInformationModel->has_withholding_tax = $salaryHasWithholdingTax;
            $salaryInformationModel->has_philhealth = $salaryHasPhilhealth;
            $salaryInformationModel->has_pagibig = $salaryHasPagibig;
            $salaryInformationModel->with_previous_employer = $salaryWithPreviousEmployer;
            $salaryInformationModel->exclude_from_payroll = $salaryExcludeFromPayroll;
            $salaryInformationModel->exclude_from_tar = $salaryExcludeFromTar;
            $salaryInformationModel->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', 'Employee #: ' . $employeeNumber . ' has been successfully updated!');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            switch ($e->getCode()) {
                case '23000':
                    $message = 'Employee #: ' . $employeeNumber . ' already exists.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/employees');
    }
}