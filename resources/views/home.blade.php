@extends('layouts.app')
@section('content')
<script type="text/javascript">
$(function () {
    $.ajax({
        type: 'get',
        url: '/ajax/perks/gift-certificates/reports',
        dataType: 'json',
        data: {
            'type': 'monthly'
        },
        success: function (data) {
            // Morris Chart Area
            // Area Chart
            Morris.Area({
                element: 'morris-area-chart',
//        data: [{"date":"2017-01-01","ek":12,"eplus":10,"mercury":11,"none":9,"rustans":9,"shopwise":13,"sm":6,"waltermart":15},{"date":"2017-02-01","ek":10,"eplus":10,"mercury":10,"none":11,"rustans":4,"shopwise":11,"sm":11,"waltermart":14},{"date":"2017-03-01","ek":17,"eplus":10,"mercury":9,"none":12,"rustans":8,"shopwise":7,"sm":11,"waltermart":15},{"date":"2017-04-01","ek":14,"eplus":12,"mercury":14,"none":9,"rustans":11,"shopwise":7,"sm":14,"waltermart":12},{"date":"2017-05-01","ek":13,"eplus":13,"mercury":13,"none":8,"rustans":12,"shopwise":6,"sm":13,"waltermart":9},{"date":"2017-06-01","ek":19,"eplus":13,"mercury":11,"none":7,"rustans":9,"shopwise":12,"sm":9,"waltermart":7},{"date":"2017-07-01","ek":14,"eplus":15,"mercury":12,"none":10,"rustans":13,"shopwise":8,"sm":13,"waltermart":6},{"date":"2017-08-01","ek":10,"eplus":12,"mercury":12,"none":8,"rustans":13,"shopwise":5,"sm":16,"waltermart":9},{"date":"2017-09-01","ek":6,"eplus":14,"mercury":7,"none":5,"rustans":16,"shopwise":12,"sm":17,"waltermart":10},{"date":"2017-10-01","ek":11,"eplus":13,"mercury":14,"none":11,"rustans":9,"shopwise":14,"sm":9,"waltermart":13},{"date":"2017-11-01","ek":8,"eplus":8,"mercury":14,"none":11,"rustans":10,"shopwise":10,"sm":13,"waltermart":16},{"date":"2017-12-01","ek":15,"eplus":8,"mercury":11,"none":14,"rustans":12,"shopwise":9,"sm":8,"waltermart":12}],
                data: data,
                xkey: 'date',
                ykeys: ['sm', 'eplus', 'mercury', 'ek', 'none', 'rustans', 'waltermart', 'shopwise'],
                labels: ['SM Gift Certificate', 'Eplus Load', 'Mercury Drug GC', 'Enchanged Kingdom Wizard Money', 'None', 'Rustans GC', 'Waltermart GC', 'Shopwise GC'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });
        }
    });
});
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                </div>
                <div class="panel-body">
                    <div id="morris-area-chart" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
