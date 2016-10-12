@if (Auth::check())
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="/home"><i class="fa fa-fw fa-home"></i> Home</a>
        </li>
        <li class="">
            <a href="/teams/status/1"><i class="fa fa-fw fa-users"></i> Team Status</a>
        </li>
        <li class="">
            <a href="/leaves"><i class="fa fa-fw fa-plane"></i> Leave Records</a>
        </li>
        <li class="">
            <a href="/overtimes"><i class="fa fa-fw fa-clock-o"></i> Overtime Records</a>
        </li>
        <li class="">
            <a href="/approvals"><i class="fa fa-thumbs-o-up"></i> Approvals</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo" class="collapsed" aria-expanded="false"><i class="fa fa-user"></i> HR <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse" aria-expanded="false">
                <li>
                    <a href="#">Time Attendance Report</a>
                </li>
                <li>
                    <a href="#">Employee Settings</a>
                </li>
                <li>
                    <a href="#">Company Settings</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
@endif