@extends('layouts.app')
@section('content')
<example></example>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Teams
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-cogs"></i> <a href="/settings/teams/add"> Settings</a>
            </li>
            <li class="active">
                Teams
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

@include('layouts.flash-message')
<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-primary" id="" href="/settings/teams/add"><i class="fa fa-plus"></i> Add Team</a>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-6">
        @if (empty($data['teams']))
            <div class="well">
                No teams yet. Would you like to <a href="/settings/teams/add"> add one</a>?
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
                    @foreach ($data['teams'] as $team)
                        <tr class="">
                            <td>{{ $team['id'] }}</td>
                            <td>{{ $team['name'] }}</td>
                            <td>{{ $data['departments'][$team['department_id']]['name'] }}</td>
                            <td>
                                <a href="/settings/teams/edit/{{ $team['id'] }}"><i class="fa fa-wrench" aria-hidden="true"></i> Configure</a>
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