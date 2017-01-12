@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Food Stubs
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-gift"></i> <a href="/perks/foodstubs"> Perks</a>
            </li>
            <li class="active">
                Food Stubs
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
@include('layouts.flash-message')
<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" id="" href="/perks/foodstubs/add"><i class="fa fa-plus"></i> Add Template</a>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        @if (empty($data['leave_templates']))
            <div class="well">
                No templates yet. Would you like to <a href="/settings/leave-templates/add"> add one</a>?
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Days of Leave</th>
                        <th>Paid</th>
                        <th>Available to Status</th>
                        <th>Available to Gender</th>
                        <th>Incremental</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['leave_templates'] as $leaveTemplate)
                        <tr class="">
                            <td>{{ $leaveTemplate['id'] }}</td>
                            <td>{{ $leaveTemplate['name'] }}</td>
                            <td>{{ $leaveTemplate['code'] }}</td>
                            <td>{{ $leaveTemplate['days'] }}</td>
                            <td>{{ (!is_null($leaveTemplate['is_paid']) ? 'Yes' : 'No') }}</td>
                            <td>{{ $leaveTemplate['available_to'] }}</td>
                            <td>{{ $leaveTemplate['available_gender'] }}</td>
                            <td>{{ (!is_null($leaveTemplate['is_incremental']) ? 'Yes' : 'No') }}</td>
                            <td>
                                <a href="/settings/leave-templates/edit/{{ $leaveTemplate['id'] }}" class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                </a>
                                <a href="#" data-url="/settings/leave-templates" data-id="{{ $leaveTemplate['id'] }}" class="btn btn-danger btn-xs delete">
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
@stop