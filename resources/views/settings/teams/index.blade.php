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
                    <i class="fa fa-cogs"></i> <a href="/settings/teams/add"> Settings</a>
                </li>
                <li class="active">
                    Teams
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" id="" href="/settings/teams/add">Add Team</a>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-6">
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
                    <tr class="">
                        <td>1</td>
                        <td>Web Developers</td>
                        <td>Engineering</td>
                        <td>
                            <a href="/settings/teams/edit/1"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                        </td>
                    </tr>
                    <tr class="">
                        <td>2</td>
                        <td>Mobile Developers</td>
                        <td>Engineering</td>
                        <td>
                            <a href="/settings/teams/edit/2"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                        </td>
                    </tr>
                    <tr class="">
                        <td>3</td>
                        <td>QA Engineers</td>
                        <td>Engineering</td>
                        <td>
                            <a href="/settings/teams/edit/3"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop