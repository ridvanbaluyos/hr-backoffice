@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Leaves
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-plane"></i> Leaves
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-primary" id="" href="/leaves/apply">Apply</a>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Date Applied</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td>1</td>
                        <td><span class="label label-warning">pending</span></td>
                        <td>Vacation Leave to Japan</td>
                        <td>Vacation</td>
                        <td>2 days</td>
                        <td>07 November 2016</td>
                        <td>18 November 2016</td>
                        <td>11 October 2016</td>
                        <td>
                            <a href="#"><i class="fa fa-undo" aria-hidden="true" style="color:red"></i> Retract</a> |
                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                        </td>
                    </tr>
                    <tr class="success">
                        <td>2</td>
                        <td><span class="label label-success">approved</span></td>
                        <td>Fetch girlfriend in the airport</td>
                        <td>Emergency</td>
                        <td>1 day</td>
                        <td>1 November 2016</td>
                        <td>1 November 2016</td>
                        <td>11 October 2016</td>
                        <td>
                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>3</td>
                        <td><span class="label label-danger">retracted</span></td>
                        <td>Vacation Leave to Japan</td>
                        <td>Vacation</td>
                        <td>2 days</td>
                        <td>07 November 2016</td>
                        <td>18 November 2016</td>
                        <td>11 October 2016</td>
                        <td>
                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td>4</td>
                        <td><span class="label label-danger">rejected</span></td>
                        <td>Vacation Leave to Japan</td>
                        <td>Vacation</td>
                        <td>2 days</td>
                        <td>07 November 2016</td>
                        <td>18 November 2016</td>
                        <td>11 October 2016</td>
                        <td>
                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
