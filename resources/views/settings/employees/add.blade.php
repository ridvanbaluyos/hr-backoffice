@extends('layouts.app')
@section('content')
<!-- Datetime Picker CSS -->
<link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Employees
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-cogs"></i> <a href="/settings/employees"> Settings</a>
            </li>
            <li class="">
                <a href="/settings/employees"> Employees</a>
            </li>
            <li class="active">
                @if (isset($data['employee']))
                    Edit
                @else
                    Add
                @endif
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    @if (isset($data['employee']))
        {{ Form::open(['url' => '/settings/employees/edit/' . $data['employee']['id'], 'method' => 'post', 'name' => 'employeeForm']) }}
    @else
        {{ Form::open(['url' => '/settings/employees/add', 'method' => 'post', 'name' => 'employeeForm']) }}
    @endif
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Employee Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('employee_number', 'Employee Number') }}
                                    @if (isset($data['employee']))
                                        {{ Form::text('employee_number', (isset($data['employee'])) ? $data['employee']['employee_number'] : '', ['class' => 'form-control', 'id' => 'employee_number', 'readonly' => 'readonly']) }}
                                    @else
                                        {{ Form::text('employee_number', (isset($data['employee'])) ? $data['employee']['employee_number'] : '', ['class' => 'form-control', 'id' => 'employee_number']) }}
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_firstname', 'First Name') }}
                                    {{ Form::text('employee_firstname', (isset($data['employee'])) ? $data['employee']['first_name'] : '', ['class' => 'form-control', 'id' => 'employee_firstname']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_middlename', 'Middle Name') }}
                                    {{ Form::text('employee_middlename', (isset($data['employee'])) ? $data['employee']['middle_name'] : '', ['class' => 'form-control', 'id' => 'employee_middlename']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_lastname', 'Last Name') }}
                                    {{ Form::text('employee_lastname', (isset($data['employee'])) ? $data['employee']['last_name'] : '', ['class' => 'form-control', 'id' => 'employee_lastname']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_gender', 'Gender') }}
                                    {{ Form::select('employee_gender', $data['gender'], (isset($data['employee']['gender']) ? $data['employee']['gender'] : null), ['class' => 'form-control', 'placeholder' => '[Select Gender]']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_marital_status', 'Marital Status') }}
                                    {{ Form::select('employee_marital_status', $data['marital_status'], (isset($data['employee']['marital_status']) ? $data['employee']['marital_status'] : null), ['class' => 'form-control', 'placeholder' => '[Select Marital Status]']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_birthday', 'Birthday') }}
                                    <div class="input-group date datepicker" id="employee_birthday">
                                        {{ Form::text('employee_birthday', (isset($data['employee'])) ? $data['employee']['birthdate'] : '', ['class' => 'form-control', 'id' => 'employee_birthday']) }}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('employee_status', 'Employee Status') }}
                                    {{ Form::select('employee_status', $data['employee_status'], (isset($data['employee']['employee_status']) ? $data['employee']['employee_status'] : null), ['class' => 'form-control', 'placeholder' => '[Select Employee Status]']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_date_hired', 'Date Hired') }}
                                    <div class="input-group date datepicker" id="employee_date_hired">
                                        {{ Form::text('employee_date_hired', (isset($data['employee'])) ? $data['employee']['date_hired'] : '', ['class' => 'form-control', 'id' => 'employee_date_hired']) }}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('employee_date_regularized', 'Date Regularized') }}
                                    <div class="input-group date datepicker" id="employee_date_regularized">
                                        {{ Form::text('employee_date_regularized', (isset($data['employee'])) ? $data['employee']['date_regularized'] : '', ['class' => 'form-control', 'id' => 'employee_date_regularized']) }}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="employee_department">Department</label>
                                    <select name="employee_department" class="form-control">
                                        <option value="">[Select Department]</option>
                                        @foreach ($data['departments'] as $department)
                                            @if (isset($data['employee']))
                                                <option value="{{ $department['id'] }}" @if($department['id'] == $data['employee']['department_id']) selected="selected" @endif>{{ $department['name'] }}</option>
                                            @else
                                                <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employee_team">Team</label>
                                    <select name="employee_team" class="form-control">
                                        <option value="">[Select Team]</option>
                                        @foreach ($data['teams'] as $team)
                                            @if (isset($data['employee']))
                                                <option value="{{ $team['id'] }}" @if($team['id'] == $data['employee']['department_id']) selected="selected" @endif>{{ $team['name'] }}</option>
                                            @else
                                                <option value="{{ $team['id'] }}">{{ $team['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <h3 class="panel-title">Account Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('account_username', 'Username') }}
                                    {{ Form::text('account_username', (isset($data['account'])) ? $data['account']['username'] : '', ['class' => 'form-control', 'id' => 'account_username']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('account_password', 'Password') }}
                                    {{ Form::password('account_password', ['class' => 'form-control', 'id' => 'account_password']) }}
                                    <small>
                                        <label>
                                            {{ Form::checkbox('show_password', '1', false) }} Show Password
                                        </label>
                                    <a href="#">Generate Password</a>
                                    </small>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('account_password_confirmation', 'Confirm Password') }}
                                    {{ Form::password('account_password_confirmation', ['class' => 'form-control', 'id' => 'account_password_confirmation']) }}
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('account_email', 'Email') }}
                                    {{ Form::text('account_email', (isset($data['account'])) ? $data['account']['email'] : '', ['class' => 'form-control', 'id' => 'account_email']) }}
                                </div>
                                <div class="form-group">
                                    <label>User Role</label>
                                    {{ Form::label('account_role', 'User Role') }}
                                    {{ Form::select('account_role', $data['backoffice_roles'], (isset($data['account']['role']) ? $data['account']['role'] : null), ['class' => 'form-control', 'placeholder' => '[Select Account Role]']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('account_biometrics_id', 'Biometrics ID') }}
                                    {{ Form::text('account_biometrics_id', (isset($data['account'])) ? $data['account']['biometrics_id'] : '', ['class' => 'form-control', 'id' => 'account_biometrics_id']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <h3 class="panel-title">Government Numbers</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('government_number_tin', 'TIN') }}
                                    {{ Form::text('government_number_tin', (isset($data['government_number'])) ? $data['government_number']['tin'] : '', ['class' => 'form-control', 'id' => 'government_number_tin']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('government_number_philhealth', 'PhilHealth') }}
                                    {{ Form::text('government_number_philhealth', (isset($data['government_number'])) ? $data['government_number']['philhealth'] : '', ['class' => 'form-control', 'id' => 'government_number_philhealth']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('government_number_pagibig', 'Pag-ibig') }}
                                    {{ Form::text('government_number_pagibig', (isset($data['government_number'])) ? $data['government_number']['pagibig'] : '', ['class' => 'form-control', 'id' => 'government_number_pagibig']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('government_number_sss', 'SSS') }}
                                    {{ Form::text('government_number_sss', (isset($data['government_number'])) ? $data['government_number']['sss'] : '', ['class' => 'form-control', 'id' => 'government_number_sss']) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('government_number_tax_status', 'Tax Status') }}
                                    {{ Form::select('government_number_tax_status', $data['tax_status'], (isset($data['government_number']['tax_status']) ? $data['government_number']['tax_status'] : null), ['class' => 'form-control', 'placeholder' => '[Select Tax Status]']) }}
                                </div>
                                <div class="form-group">
                                    <label>PhilHealth Effective Coverage Date</label>
                                    <div class="input-group date datepicker" id="government_number_philhealth_effectivity_date">
                                        {{ Form::text('government_number_philhealth_effectivity_date', (isset($data['government_number'])) ? $data['government_number']['philhealth_effectivity_date'] : '', ['class' => 'form-control', 'id' => 'government_number_philhealth_effectivity_date']) }}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('government_number_pagibig_contribution', 'Fixed Pag-ibig Contribution') }}
                                    {{ Form::text('government_number_pagibig_contribution', (isset($data['government_number'])) ? $data['government_number']['pagibig_contribution'] : '', ['class' => 'form-control', 'id' => 'government_number_pagibig_contribution']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('government_number_withholding_tax', 'BIR Expanded Witholding Tax') }}
                                    {{ Form::select('government_number_withholding_tax', $data['withholding_tax'], (isset($data['government_number']['withholding_tax']) ? $data['government_number']['withholding_tax'] : null), ['class' => 'form-control', 'placeholder' => '[Select Withholding Tax]']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{----}}
            {{--<div class="col-lg-12">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<h3 class="panel-title">Salary Information</h3>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Salary Type</label>--}}
                                    {{--<select name="" class="form-control">--}}
                                        {{--<option>[Select Salary Type]</option>--}}
                                        {{--<option></option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Basic Salary</label>--}}
                                    {{--<input class="form-control" />--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Hourly Rate</label>--}}
                                    {{--<input type="checkbox" /><input class="form-control" disabled="disabled"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Non-Taxable Allowance</label>--}}
                                    {{--<input type="checkbox" /><input class="form-control" disabled="disabled"/>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Taxable Allowance</label>--}}
                                    {{--<input type="checkbox" /><input class="form-control" disabled="disabled"/>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Gross Salary</label>--}}
                                    {{--<input class="form-control" />--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Bank Name</label>--}}
                                    {{--<select name="" class="form-control">--}}
                                        {{--<option>[Select Bank]</option>--}}
                                        {{--<option></option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Bank Account No.</label>--}}
                                    {{--<input class="form-control" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{----}}
            <div class="col-lg-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <h3 class="panel-title">Salary Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_ot_applicable', '1', (isset($data['salary'])) ? $data['salary']['ot_applicable'] : false) }} OT Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_late_applicable', '1', (isset($data['salary'])) ? $data['salary']['late_applicable'] : false) }} Late Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_undertime_applicable', '1', (isset($data['salary'])) ? $data['salary']['undertime_applicable'] : false) }} Undertime Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_night_diff_applicable', '1', (isset($data['salary'])) ? $data['salary']['night_diff_applicable'] : false) }} Night Diff Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_holiday_applicable', '1', (isset($data['salary'])) ? $data['salary']['holiday_applicable'] : false) }} Holiday Applicable
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Payroll Group</label>
                                    <select name="salary_payroll_group" class="form-control">
                                        <option>[Select Payroll Group]</option>
                                        <option value="all" selected="selected">All</option>
                                    </select>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_exclude_from_payroll', '1', (isset($data['salary'])) ? $data['salary']['exclude_from_payroll'] : false) }} Exclude from Payroll
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_exclude_from_tar', '1', (isset($data['salary'])) ? $data['salary']['exclude_from_tar'] : false) }} Exclude From TAR
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_has_sss', '1', (isset($data['salary'])) ? $data['salary']['has_sss'] : false) }} Has SSS
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_has_withholding_tax', '1', (isset($data['salary'])) ? $data['salary']['has_withholding_tax'] : false) }} Has Witholding Tax
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_has_philhealth', '1', (isset($data['salary'])) ? $data['salary']['has_philhealth'] : false) }} Has PhilHealth
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_has_pagibig', '1', (isset($data['salary'])) ? $data['salary']['has_pagibig'] : false) }} Has Pag-ibig
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('salary_with_previous_employer', '1', (isset($data['salary'])) ? $data['salary']['with_previous_employer'] : false) }} With Previous Employer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@if (isset($data['employee']))Update @else Add @endif Employee</button>
                <a href="/settings/employees" class="btn btn-link">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop