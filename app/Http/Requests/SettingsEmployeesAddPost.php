<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsEmployeesAddPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Employee Information
            'employee_number' =>'required|max:32',
            'employee_firstname' => 'required|max:32',
            'employee_middlename' => 'required|max:32',
            'employee_lastname' => 'required|max:32',
            'employee_gender' => 'required|in:Male,Female',
            'employee_marital_status' => 'required|in:Single,Married,Separated,Widowed',
            'employee_birthday' => 'required|date|date_format:Y-m-d',
            'employee_status' => 'required|in:Trainee,Probationary,Regular,Officer,Freelance,Terminated,Resigned,Contractual,Retired,End of Contract,Consultant,Projet,Transferred,Deceased',
            'employee_date_hired' => 'required|date|date_format:Y-m-d',
            'employee_date_regularized' => 'date|date_format:Y-m-d',
            'employee_department' => 'required|integer',
            'employee_team' => 'required|integer',

            // Account Information
            'account_username' => 'required|max:32',
            'account_password' => 'confirmed',
            'account_email' => 'required|email',
            'account_role' => 'required|in:Administrator,User',
            'account_biometrics_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Employee Information
            'employee_number.required' => 'Employee Information > Employee Number is required.',
            'employee_number.max' => 'Employee Information> Employee Number should be less than 32 characters.',
            'employee_firstname.required' => 'Employee Information > Employee Firstname is required.',
            'employee_firstname.max' => 'Employee Information> Employee Firstname should be less than 32 characters.',
            'employee_lastname.required' => 'Employee Information > Employee Lastname is required.',
            'employee_lastname.max' => 'Employee Information> Employee Lastname should be less than 32 characters.',
            'employee_middlename.required' => 'Employee Information > Employee Middlename is required.',
            'employee_middlename.max' => 'Employee Information> Employee Middlename should be less than 32 characters.',
            'employee_gender.required' => 'Employee Information > Employee Gender is required.',
            'employee_marital_status.required' => 'Employee Information > Employee Marital Status is required.',
            'employee_date_hired.required' => 'Employee Information > Employee Date Hired is required.',
            'employee_date_hired.date' => 'Employee Information > Employee Date Hired is not a valid date.',
            'employee_date_hired.date_format' => 'Employee Information > Employee Date Hired has an invalid format.',
            'employee_date_regularized.required' => 'Employee Information > Employee Date Regularized is required.',
            'employee_date_regularized.date' => 'Employee Information > Employee Date Regularized is not a valid date.',
            'employee_date_regularized.date_format' => 'Employee Information > Employee Date Regularized has an invalid format.',
            'employee_department.required' => 'Employee Information > Employee Department is required.',
            'employee_team.required' => 'Employee Information > Employee Team is required.',

            // Account Information
            'account_email.required' => 'Account Information > Email is required.',
            'account_email.email' => 'Account Information > Email is invalid.',
            'account_password.confirmed' => 'Account Information > Passwords do not match.',
            'account_role.required' => 'Account Information > Role is required.',
            'account_role.in' => 'Account Information > Role is invalid.',
            'account_biometrics_id.required' => 'Account Information > Biometrics ID is required.',

            // Government Numbers
            'government_number_tin' => 'Government Numbers > Tax Identification Number (TIN) is required.',
            'government_number_philhealth' => 'Government Numbers > Philhealth Number is required.',
            'government_number_pagibig' => 'Government Numbers > Pagibig Number is required.',
            'government_number_sss' => 'Government Numbers > Social Security System (SSS) Number is required.',
            'government_number_tax_status' => 'Government Numbers > Tax Status is required.',
            'government_number_withholding_tax' => 'Government Numbers > Withholding Tax is required.',
        ];
    }
}
