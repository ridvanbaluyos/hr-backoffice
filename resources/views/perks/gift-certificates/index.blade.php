@extends('layouts.app')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Gift Certificates
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-gift"></i> <a href="/perks/gift-certificates"> Perks</a>
                </li>
                <li class="active">
                    Gift Certificates
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    @include('layouts.flash-message')
    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['url' => '/perks/gift-certificates/' . Auth::user()->id, 'method' => 'post', 'name' => 'giftCertificateForm']) }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-calendar fa-fw"></i> Monthly Perks</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Month</th>
                                <th>Perks</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['months'] as $idx=>$month)
                                <tr>
                                    <td>
                                        {{ $month }}
                                    </td>
                                    <td>
                                        @if (empty($data['gc']))
                                            {{ Form::select('gift_certificate[' . $idx .']', $data['gift_certificates'], 'eplus', ['class' => 'form-control', 'placeholder' => '[Select Gift Certificate]']) }}
                                        @else
                                            @if (in_array($data['gc'][--$idx]['status'], ['submitted', 'redeemed']))
                                                {{ Form::select('gift_certificate[' . $idx .']', $data['gift_certificates'], ($data['gc'][$idx]) ?  : 'eplus', ['class' => 'form-control', 'placeholder' => '[Select Gift Certificate]', 'disabled' => 'disabled']) }}
                                            @else
                                                {{ Form::select('gift_certificate[' . $idx .']', $data['gift_certificates'], 'eplus', ['class' => 'form-control', 'placeholder' => '[Select Gift Certificate]']) }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($data['gc']))
                                            <span class="label label-info">open</span>
                                        @else
                                            @if ($data['gc'][$idx]['status'] == 'submitted')
                                                <span class="label label-warning">{{ $data['gc'][$idx]['status'] }}</span>
                                            @elseif ($data['gc'][$idx]['status'] == 'redeemed')
                                                <span class="label label-success">{{ $data['gc'][$idx]['status'] }}</span>
                                            @else
                                                <span class="label label-info">open</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">@if (isset($data['employee']))Update @else Submit @endif</button>
            <a href="/settings/employees" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@stop