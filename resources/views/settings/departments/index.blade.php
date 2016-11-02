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
                <i class="fa fa-cogs"></i> <a href="/settings/departments/add"> Settings</a>
            </li>
            <li class="active">
                Departments
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

@include('layouts.flash-message')
<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-primary" id="" href="/settings/departments/add">Add Department</a>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-6">
        @if ($data['departments']->isEmpty())
            <div class="well">
                No departments yet. Would you like to <a href="/settings/departments/add"> add one</a>?
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['departments'] as $department)
                        <tr class="">
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>
                            <td>
                                <a href="/settings/departments/edit/{{ $department->id }}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
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
@stop