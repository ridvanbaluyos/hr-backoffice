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
                    Add
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-4">
            <form name="teamNameForm" method="POST" action="">
                <div class="form-group">
                    <label for="team_name">What is the name of the team?</label>
                    <input type="text" class="form-control" id="team_name" placeholder="Team Name">
                </div>
                <div class="form-group">
                    <label for="team_department">Which department does this team belong?</label>
                    <select name="team_department" class="form-control">
                        <option>Engineering</option>
                        <option>Product</option>
                        <option>Human Resources</option>
                        <option>Marketing</option>
                        <option>Customer Success</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Team</button>
            </form>
        </div>
    </div>
@stop