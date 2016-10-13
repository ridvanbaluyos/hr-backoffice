@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Departments
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-cogs"></i> <a href="/settings/departments"> Settings</a>
            </li>
            <li class="">
                <a href="/settings/departments"> Departments</a>
            </li>
            <li class="active">
                @if (isset($data['department']))
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
    <div class="col-lg-4">
        @if (isset($data['department']))
            <form name="addDepartmentForm" method="POST" action="{{ url('/settings/departments/edit/' . $data['department']['id']) }}">
        @else
            <form name="addDepartmentForm" method="POST" action="{{ url('/settings/departments/add') }}">
        @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="departmentName">What is the name of the department?</label>
                <input type="text" class="form-control" id="departmentName" placeholder="Department Name" name="department_name" value="@if (isset($data['department'])){{ $data['department']['name'] }}@endif"">
            </div>
            <button type="submit" class="btn btn-primary">@if (isset($data['department']))Update @else Add @endif Department</button>
        </form>
    </div>
</div>
@stop