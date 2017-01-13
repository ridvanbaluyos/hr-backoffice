@extends('layouts.app')
@section('content')
<script type="text/javascript">
//    $(function () {
//        $('#submit_gc').click(function () {
//            swal({
//                title: 'Are you sure?',
//                text: "You won't be able to edit this once submitted",
//                type: 'warning',
//                showCancelButton: true,
//                confirmButtonColor: '#3085d6',
//                cancelButtonColor: '#d33',
//                confirmButtonText: 'Yes, I want these GCs!'
//            }).then(function () {
//                swal(
//                    'Success!',
//                    'Your choices have now been submitted.',
//                    'success'
//                )
//            })
//        });
//    });
</script>
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
                                            @if (isset($data['gc'][--$idx]['status']))
                                                {{ $data['gift_certificates'][$data['gc'][$idx]['perk']] }}
                                            @else
                                                {{ Form::select('gift_certificate[' . $idx .']', $data['gift_certificates'], 'eplus', ['class' => 'form-control', 'placeholder' => '[Select Gift Certificate]']) }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($data['gc']) && !isset($data['gc'][$idx]))
                                            <span class="label label-info">open</span>
                                        @else
                                            @if (isset($data['gc'][$idx]['status']))
                                                @if ($data['gc'][$idx]['status'] == 'submitted')
                                                    <span class="label label-warning">{{ $data['gc'][$idx]['status'] }}</span>
                                                @elseif ($data['gc'][$idx]['status'] == 'redeemed')
                                                    <span class="label label-success">{{ $data['gc'][$idx]['status'] }}</span>
                                                @endif
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
            <button type="submit" class="btn btn-primary" id="submit_gc">@if (isset($data['employee']))Update @else Submit @endif</button>
            <a href="/settings/employees" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@stop