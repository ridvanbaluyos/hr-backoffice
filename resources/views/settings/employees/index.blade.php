@extends('layouts.app')
@section('content')
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
            <li class="active">
                Employees
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
@include('layouts.flash-message')
<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" id="" href="/settings/employees/add"><i class="fa fa-plus"></i> Add Employee</a>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        @if (empty($data['employees']))
            <div class="well">
                No employees yet. Would you like to <a href="/settings/employees/add"> add one</a>?
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Team</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['employees'] as $employee)
                        <tr class="">
                            <td>{{ $employee['employee_number'] }}</td>
                            <td><a href="/employee/{{ $employee['id'] }}">{{ $employee['last_name'] }}, {{ $employee['first_name'] }}</a></td>
                            <td>{{ $employee['position'] }}</td>
                            <td>{{ $data['teams'][$employee['team_id']]['name'] }}</td>
                            <td>{{ $data['departments'][$employee['department_id']]['name'] }}</td>
                            <td>
                                <a href="/settings/employees/edit/{{ $employee['id'] }}" class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                </a>
                                <a href="#" data-url="/settings/employees" data-id="{{ $employee['id'] }}" class="btn btn-danger btn-xs delete">
                                    <i class="fa fa-times" aria-hidden="true"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12" align="center">
        {{ $data['employees']->links() }}
    </div>
</div>
@stop