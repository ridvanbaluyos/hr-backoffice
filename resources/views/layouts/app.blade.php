<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HR Backoffice | OLX.ph</title>

    <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">
    <script src="{{ elixir('assets/js/app.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div @if (Auth::check())id="wrapper" @endif>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <!-- Top Menu Items -->
        @include('layouts.topbar')

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        @include('layouts.sidebar')
    <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Datetime Picker JS -->
<script type="text/javascript">
    $(function () {
        $('#apply_leave_startdate, #employee_date_hired, #employee_date_regularized, #employee_philhealth_effectivity').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: new Date(),
            useCurrent: true,
        });

        $('#employee_birthday').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#logout').click(function () {

        });
    });
</script>
</body>
</html>
