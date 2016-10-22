@extends('layouts.app')
@section('content')
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
                    <label for="team_managers">Managers</label> <a href="#" class="btn btn-success btn-xs">Add Manager</a>
                    <div class="table-responsive" id="team_managers">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr class="">
                                <td>1</td>
                                <td>Fredereick Stephen Bangug</td>
                                <td>Senior Software Engineer</td>
                                <td>Engineering</td>
                                <td>
                                    <a href="#"><i class="fa fa-remove" style="color:red" aria-hidden="true"></i> Delete</a>
                                </td>
                            </tr>
                            <tr class="">
                                <td>1</td>
                                <td>Romelo Noel Santos</td>
                                <td>Chief Technology Officer</td>
                                <td>Engineering</td>
                                <td>
                                    <a href="#"><i class="fa fa-remove" style="color:red" aria-hidden="true"></i> Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <label for="team_members">Members</label> <a href="#" class="btn btn-success btn-xs">Add Member</a>
                    <div class="table-responsive" id="team_members">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td>1</td>
                                    <td>Frederick Stephen Bangug</td>
                                    <td>Senior Software Engineer</td>
                                    <td>Engineering</td>
                                    <td>
                                        <a href="#"><i class="fa fa-remove" style="color:red" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>2</td>
                                    <td>Ridvan Lakas ng Bayan Baluyos</td>
                                    <td>Senior Software Engineer</td>
                                    <td>Engineering</td>
                                    <td>
                                        <a href="#"><i class="fa fa-remove" style="color:red" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>3</td>
                                    <td>Kyle Alaine Domingo</td>
                                    <td>Software Engineer</td>
                                    <td>Engineering</td>
                                    <td>
                                        <a href="#"><i class="fa fa-remove" style="color:red" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>1</td>
                                    <td>Alexander Galdones</td>
                                    <td>Software Engineer</td>
                                    <td>Engineering</td>
                                    <td>
                                        <a href="#"><i class="fa fa-remove" style="color:red" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">@if (isset($data['team']))Update @else Add @endif Team</button>
                <a href="/settings/teams" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@stop