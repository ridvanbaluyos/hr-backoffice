@extends('layouts.app')
@section('content')
<!-- Datetime Picker CSS -->
<link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Leaves
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-plane"></i> <a href="/leaves"> Leaves</a>
            </li>
            <li class="active">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Apply
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-4">
        <form name="leaveForm">
            <div class="form-group">
                <label for="leaveType">What kind of leave do you want to apply?</label>
                <select name="leaveType" class="form-control">
                    <option>Vacation Leave</option>
                    <option>Sick Leave</option>
                    <option>Emergency Leave</option>
                    <option>Maternity Leave</option>
                    <option>Paternity Leave</option>
                </select>
            </div>
            <div class="form-group">
                <label for="apply_leave_startdate">When will it start?</label>
                <div class='input-group date' id='apply_leave_startdate'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="leaveDuration">How many days?</label>
                <select name="leaveDuration" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="leaveDescription">What is your reason for applying this leave?</label>
                <textarea name="leaveDescription" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Apply Leave</button>
        </form>
    </div>
</div>

@stop