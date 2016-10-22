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
                <a href="/settings/employees"> Teams</a>
            </li>
            <li class="active">
                @if (isset($data['team']))
                    Edit
                @else
                    Add
                @endif
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    @if (isset($data['team']))
        <form name="teamNameForm" method="POST" action="{{ url('/settings/employees/edit/' . $data['team']['id']) }}">
    @else
        <form name="teamNameForm" method="POST" action="{{ url('/settings/employees/add') }}">
    @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Employee Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="employee_id">Employee ID</label>
                                    <input class="form-control" name="employee_id" id="employee_id" />
                                </div>
                                <div class="form-group">
                                    <label for="employee_firstname">First Name</label>
                                    <input class="form-control" name="employee_firstname" id="employee_firstname" />
                                </div>
                                <div class="form-group">
                                    <label for="employee_middlename">Middle Name</label>
                                    <input class="form-control" name="employee_middlename" id="employee_middle" />
                                </div>
                                <div class="form-group">
                                    <label for="employee_lastname">Last Name</label>
                                    <input class="form-control" name="employee_lastname" id="employee_lastname" />
                                </div>
                                <div class="form-group">
                                    <label for="employee_gender">Gender</label>
                                    <select name="employee_gender" class="form-control">
                                        <option value="">[Select Gender]</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employee_marital_status">Marital Status</label>
                                    <select name="" class="form-control">
                                        <option value="">[Select Marital Status]</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employee_birthday">Birthday</label>
                                    <div class="input-group date datepicker" id="employee_birthday">
                                        <input type="text" class="form-control" name="employee_birthday" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Employee Status</label>
                                    <select name="employee_status" class="form-control">
                                        <option value="">[Select Employee Status]</option>
                                        <option value="Probationary">Probationary</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Contractual">Contractual</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employee_date_hired">Date Hired</label>
                                    <div class="input-group date datepicker" id="employee_date_hired">
                                        <input type="text" class="form-control" name="employee_date_hired" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="employee_date_regularized">Date Regularized</label>
                                    <div class="input-group date datepicker" id="employee_date_regularized">
                                        <input type="text" class="form-control" name="employee_date_regularized" />
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
                                            @if (isset($data['team']))
                                                <option value="{{ $department['id'] }}" @if($department['id'] == $data['team']['department_id']) selected="selected" @endif>{{ $department['name'] }}</option>
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
                                            @if (isset($data['team']))
                                                <option value="{{ $team['id'] }}" @if($team['id'] == $data['team']['department_id']) selected="selected" @endif>{{ $team['name'] }}</option>
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Account Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" type="password" />
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">Show Password
                                    </label>
                                </div>
                                <button type="button" class="btn btn-xs btn-info">Generate Password</button>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select name="" class="form-control">
                                        <option>[Select User Role]</option>
                                        <option>User</option>
                                        <option>Admin</option>
                                        <option>HR</option>
                                        <option>Finance</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Biometrics ID</label>
                                    <input class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Government Numbers</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>TIN</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>PhilHealth</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Pag-ibig</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>SSS</label>
                                    <input class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tax Status</label>
                                    <select name="" class="form-control">
                                        <option>[Select Tax Status]</option>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>PhilHealth Effective Coverage Date</label>
                                    <div class='input-group date datepicker' id='employee_philhealth_effectivity'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Fixed Pag-ibig Contribution</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>BIR Expanded Witholding Tax</label>
                                    <select name="" class="form-control">
                                        <option>[Select Tax Status]</option>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Salary Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Salary Type</label>
                                    <select name="" class="form-control">
                                        <option>[Select Salary Type]</option>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Basic Salary</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Hourly Rate</label>
                                    <input type="checkbox" /><input class="form-control" disabled="disabled"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Non-Taxable Allowance</label>
                                    <input type="checkbox" /><input class="form-control" disabled="disabled"/>
                                </div>
                                <div class="form-group">
                                    <label>Taxable Allowance</label>
                                    <input type="checkbox" /><input class="form-control" disabled="disabled"/>
                                </div>
                                <div class="form-group">
                                    <label>Gross Salary</label>
                                    <input class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <select name="" class="form-control">
                                        <option>[Select Bank]</option>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Bank Account No.</label>
                                    <input class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Salary Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> OT Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Late Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Undertime Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Night Diff Applicable
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Holiday Applicable
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Payroll Group</label>
                                    <select name="" class="form-control">
                                        <option>[Select Payroll Group]</option>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Exclude From Payroll
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Exclude From TAR
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Has SSS
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Has Witholding Tax
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Has PhilHealth
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Has Pag-ibig
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> With Previous Employer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@if (isset($data['employee']))Update @else Add @endif Team</button>
                <a href="/settings/employees" class="btn btn-link">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop