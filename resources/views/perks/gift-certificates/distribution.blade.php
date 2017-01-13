@extends('layouts.app')
@section('content')
<script type="text/javascript">
$(function () {
    $('.redeem').click(function () {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var month = $(this).attr('data-month');
        var perk = $(this).attr('data-perk');

        swal({
            title: 'Are you sure?',
            text: "This action is irreversible.",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Redeem'
        }).then(function () {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'put',
                url: '/ajax' + url,
                dataType: 'json',
                data: {
                    'id' : id,
                    'month' : month,
                    'perk' : perk
                },
                success : function (data) {
                    if (data.status == 'ok') {
                        swal(
                                'Redeemd!',
                                'Gift Certificate successfully redeemed!',
                                'success'
                        ).then(function () {
                            // Reload page after successfully adding team manager
                            location.reload();
                        })
                    } else {
                        swal(
                                'Error!',
                                'Something went wrong',
                                'error'
                        );
                    }
                }
            });
        });
    });
});
</script>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Gift Certificates Distribution
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-gift"></i> <a href="/perks/gift-certificates"> Perks</a>
            </li>
            <li class="active">
                Gift Certificates Distribution
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
@include('layouts.flash-message')
<div class="row">
    <div class="col-lg-12">
        <form method="POST" action="//perks/gift-certificates/distribution" accept-charset="UTF-8" class="navbar-form navbar-left">
            <div class="form-group">
                {{ Form::label('', 'Filters') }}:
                {{ Form::select('month', $data['months'], (Session::has('month')) ? Session::get('month') : date('m'), ['class' => 'form-control', 'placeholder' => '[Select Month]']) }}
                <select class="form-control" name="gift_certificate">
                    <option value="all">All</option>
                    @foreach ($data['gift_certificates'] as $perk=>$gift_certificate)
                        <option value="{{ $perk }}" @if(Session::get('perk') == $perk) selected="selected" @endif>{{ $gift_certificate }}</option>
                    @endforeach
                </select>
                <select name="department" id="department" class="form-control">
                    <option value="all">All</option>
                    @foreach ($data['departments'] as $department)
                        <option value="{{ $department['id'] }}" @if(Session::get('department') == $department) selected="selected" @endif >{{ $department['name'] }}</option>
                    @endforeach
                </select>
                <select name="team" id="team" class="form-control">
                    <option value="all">All</option>
                    @foreach ($data['teams'] as $team)
                        <option value="{{ $team['id'] }}" class="{{ $team['department_id'] }}">{{ $team['name'] }}</option>
                    @endforeach
                </select>
                {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Search by Last Name']) }}
                <input type="submit" class="btn btn-info" value="Filter" />
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar fa-fw"></i> @if (Session::has('month')) {{ $data['months'][Session::get('month')] }} @else {{ 'Monthly' }} @endif  Perks</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Team</th>
                            <th>Perk</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        @foreach ($data['gc'] as $giftCertificate)
                            <tbody>
                                    <td>{{ $giftCertificate->employeeInformation->last_name }}, {{ $giftCertificate->employeeInformation->first_name }}</td>
                                    <td>{{ $data['departments'][$giftCertificate->employeeInformation->department_id]['name'] }}</td>
                                    <td>{{ $data['teams'][$giftCertificate->employeeInformation->team_id]['name'] }}</td>
                                    <td>{{ $data['gift_certificates'][$giftCertificate->perk] }}</td>
                                    <td>
                                        @if ($giftCertificate->status != 'redeemed')
                                            <a href="#" data-url="/perks/gift-certificates/redeem" data-perk="{{ $giftCertificate->perk}}" data-id="{{ $giftCertificate->employee_id }}" data-month="{{ $giftCertificate->month_year }}" class="btn btn-danger btn-xs redeem">
                                                <i class="fa fa-check-circle-o" aria-hidden="true"></i> Redeem
                                            </a>
                                        @else
                                            <span class="label label-success">redeemed</span>
                                        @endif
                                    </td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12" align="center">
        {{ $data['gc']->links() }}
    </div>
</div>
@stop