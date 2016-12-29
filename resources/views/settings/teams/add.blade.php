@extends('layouts.app')
@section('content')
@if (isset($data['team']))
<script type="text/javascript">
$(function () {
    $('#team_add_manager').click(function () {
        swal({
            title: "Search Team Manager",
            text: "Search by Last Name",
            input: "text",
            showCancelButton: true,
            confirmButtonText: "Search",
            animation: "slide-from-top",
            inputPlaceholder: "Search by last name (eg. Santos)",
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: function (lastname) {
                return new Promise (function (resolve, reject) {
                    if (lastname === false) {
                        reject('Please enter something.');
                    } else if (lastname === '') {
                        reject('Please enter something.');
                    } else {
                        $.ajax({
                            type: 'get',
                            url: '/ajax/settings/employees/search',
                            dataType: 'json',
                            data: {
                                'lastname': lastname
                            },
                            success: function (data) {
                                if (data.employee.length === 0) {
                                    reject('No records found.');
                                } else {
                                    resolve()

                                }
                            }
                        })
                    }
                })
            }
        })
        .then(function (lastname) {
            // TODO: double ajax call
            $.ajax({
                type: 'get',
                url: '/ajax/settings/employees/search',
                dataType: 'json',
                data: {
                    'lastname': lastname
                },
                success: function (data) {
                    console.log(data);

                    var teamManagerName = data.employee.first_name + " " + data.employee.last_name;

                    swal({
                        title: "Confirm Team Manager",
                        html: "Are you sure you want to make <strong>" + teamManagerName + "</strong> as Team Manager?",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        showLoaderOnConfirm: true,
                    }).then(function () {
                        $.ajax({
                            headers : {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type : 'put',
                            url : '/ajax/settings/teams/manager',
                            dataType : 'json',
                            data : {
                                'team' : {{ $data['team']['id'] }},
                                'manager' : data.employee.id
                            },
                            success : function (data) {
                                if (data.status == 'ok') {
                                    swal({
                                        type: 'success',
                                        title: 'Success!',
                                        html: teamManagerName + " has been assigned as Manager to this team."
                                    })
                                    .then(function () {
                                        // Reload page after successfully adding team manager
                                        location.reload();
                                    })

                                } else if (data.status == 'duplicate') {
                                    swal({
                                        type: 'error',
                                        title: 'Duplicate!',
                                        html: teamManagerName + " is already a Team Manager."
                                    })
                                } else {
                                    swal({
                                        type: 'error',
                                        title: 'Error!',
                                        html: "Something went wrong."
                                    })
                                }
                            }
                        });
                    });
                }
            });

        });
    });

    $('#team_add_member').click(function () {
        swal({
            title: "Error!",
            text: "Here's my error message!",
            type: "error",
            confirmButtonText: "Cool"
        });
    });
});
</script>
@endif

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Teams
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-cogs"></i> <a href="/settings/departments"> Settings</a>
            </li>
            <li class="">
                <a href="/settings/teams"> Teams</a>
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
    <div class="col-lg-6">
        @if (isset($data['team']))
            <form name="teamNameForm" method="POST" action="{{ url('/settings/teams/edit/' . $data['team']['id']) }}">
        @else
            <form name="teamNameForm" method="POST" action="{{ url('/settings/teams/add') }}">
        @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">What is the name of the team?</label>
                <input type="text" class="form-control" id="team_name" name="team_name" placeholder="Team Name" value="@if (isset($data['team'])){{ $data['team']['name'] }}@endif">
            </div>
            <div class="form-group">
                <label for="team_department">Which department does this team belong?</label>
                <select name="team_department" class="form-control">
                    <option>[Select Department]</option>
                    @foreach ($data['departments'] as $department)
                        @if (isset($data['team']))
                            <option value="{{ $department['id'] }}" @if($department['id'] == $data['team']['department_id']) selected="selected" @endif>{{ $department['name'] }}</option>
                        @else
                            <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
            @if (isset($data['team']))
                <label for="team_managers">Managers</label>
                <a href="#" class="btn btn-success btn-xs" id="team_add_manager">Add Manager</a>
                @if (empty($data['teamManagers']))
                    <div class="well">
                        No managers yet.
                    </div>
                @else
                    <div class="table-responsive" id="team_managers">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['teamManagers'] as $teamManager)
                                @if (isset($teamManager->employeeInformation))
                                    <tr class="">
                                        <td>{{ $teamManager->employeeInformation->employee_number }}</td>
                                        <td>{{ $teamManager->employeeInformation->last_name }}, {{ $teamManager->employeeInformation->first_name }}</td>
                                        <td>{{ $teamManager->employeeInformation->position }}</td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-xs delete" data-url="/settings/teams/manager" data-id="{{ $teamManager->employeeInformation->id }}">
                                                <i class="fa fa-remove" aria-hidden="true"></i> Remove
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <label for="team_members">Members</label>
                <a href="#" class="btn btn-success btn-xs" id="team_add_member">Add Member</a>
                @if (empty($data['teamMembers']))
                <div class="well">
                    No members yet.
                </div>
                @else
                    <div class="table-responsive" id="team_members">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['teamMembers'] as $teamMember)
                                <tr class="">
                                    <td>{{ $teamMember['employee_number'] }}</td>
                                    <td>{{ $teamMember['last_name'] }}, {{ $teamMember['first_name'] }}</td>
                                    <td>{{ $teamMember['position'] }}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-remove" aria-hidden="true"></i> Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            @endif
            <button type="submit" class="btn btn-primary">@if (isset($data['team']))Update @else Add @endif Team</button>
            <a href="/settings/teams" class="btn btn-link">Cancel</a>
        </form>
    </div>
</div>
@stop