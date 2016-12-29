@extends('layouts.app')
@section('content')
<script type="text/javascript">
    $(function () {

    });
</script>

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
        <a class="btn btn-success" id="" href="/settings/teams/add"><i class="fa fa-plus"></i> Add Team</a>
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
                                <a href="/settings/teams/edit/{{ $team['id'] }}" class="btn btn-warning btn-xs"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                <a href="#" data-url="/settings/teams" data-id="{{ $team['id'] }}" class="btn btn-danger btn-xs delete">
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
@stop