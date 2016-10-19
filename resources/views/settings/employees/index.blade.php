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

    <div class="row">
        <div class="col-lg-6">
            @if (Session::has('alert-message'))
                <div class="alert alert-{{ Session::get('alert-class') }}">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('alert-message') }}
                </div>
            @endif
            <a class="btn btn-primary" id="" href="/settings/employees/add">Add Employee</a>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            @if ($data['employees']->isEmpty())
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
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['employees'] as $employee)
                            <tr class="">
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <!-- /.row -->
@stop