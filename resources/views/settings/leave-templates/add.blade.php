@extends('layouts.app')
@section('content')
<!-- Chained Select -->
<script type="text/javascript" charset="utf-8">
    $(function() {

    });
</script>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Leave Templates
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-cogs"></i> <a href="/settings/leave-templates"> Settings</a>
            </li>
            <li class="">
                <a href="/settings/leave-templates"> Leave Templates</a>
            </li>
            <li class="active">
                @if (isset($data['leave_template']))
                    Edit
                @else
                    Add
                @endif
            </li>
        </ol>
    </div>
</div>

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
@if (isset($data['leave_template']))
    {{ Form::open(['url' => '/settings/leave-templates/edit/' . $data['leave_template']['id'], 'method' => 'post', 'name' => 'leaveTemplatesForm']) }}
@else
    {{ Form::open(['url' => '/settings/leave-templates/add', 'method' => 'post', 'name' => 'leaveTemplatesForm']) }}
@endif
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Leave Template</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', (isset($data['leave_template']['name'])) ? $data['leave_template']['name'] : '', ['class' => 'form-control', 'id' => 'leave_template_name']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('code', 'Code') }}
                                {{ Form::text('code', (isset($data['leave_template']['code'])) ? $data['leave_template']['code'] : '', ['class' => 'form-control', 'id' => 'leave_template_code']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('days', 'Days of Leave') }}
                                {{ Form::text('days', (isset($data['leave_template']['days'])) ? $data['leave_template']['days'] : '', ['class' => 'form-control', 'id' => 'leave_days']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ Form::label('available_to', 'Available to Status') }}
                                <label class="radio-inline">
                                    {{ Form::radio('available_to', 'All', (isset($data['leave_template']['available_to']) && $data['leave_template']['available_to'] === 'All') ? true : false) }} All
                                </label>
                                <label class="radio-inline">
                                    {{ Form::radio('available_to', 'Regular',  (isset($data['leave_template']['available_to']) && $data['leave_template']['available_to'] === 'Regular') ? true : false) }} Regular
                                </label>
                                <label class="radio-inline">
                                    {{ Form::radio('available_to', 'Probationary',  (isset($data['leave_template']['available_to']) && $data['leave_template']['available_to'] === 'Probationary') ? true : false) }} Probationary
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ Form::label('available_gender', 'Available to Gender') }}
                                <label class="radio-inline">
                                    {{ Form::radio('available_gender', 'All', (isset($data['leave_template']['available_gender']) && $data['leave_template']['available_gender'] === 'All') ? true : false) }} All
                                </label>
                                <label class="radio-inline">
                                    {{ Form::radio('available_gender', 'Male', (isset($data['leave_template']['available_gender']) && $data['leave_template']['available_gender'] === 'Male') ? true : false) }} Male
                                </label>
                                <label class="radio-inline">
                                    {{ Form::radio('leave_template_available_gender', 'Female', (isset($data['leave_template']['available_gender']) && $data['leave_template']['available_gender'] === 'Female') ? true : false) }} Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('is_incremental', '1', (isset($data['leave_template']['is_incremental']) ? true : false)) }} Has Incremental Rules?
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('is_paid', '1', (isset($data['leave_template']['is_paid']) ? true : false)) }} Is Paid?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">@if (isset($data['leave_template']))Update @else Add @endif Leave Template</button>
            <a href="/settings/leave-templates" class="btn btn-link">Cancel</a>
        </div>
    </form>
</div>
@stop