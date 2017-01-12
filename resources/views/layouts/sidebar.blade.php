@if (Auth::check())
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li @if (Request::is('home/*')) class="active"@endif>
            <a href="/home"><i class="fa fa-fw fa-home"></i> Home</a>
        </li>
        <li @if (Request::is('perks/*')) class="active"@endif>
            <a href="javascript:;" data-toggle="collapse" data-target="#perks" class="collapsed" aria-expanded="false"><i class="fa fa-gift" aria-hidden="true"></i> Perks <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="perks" @if (Request::is('perks/*')) class="collapse in" aria-expanded="true"@else class="collapse" aria-expanded="false"@endif>
                <li>
                    <a href="/perks/gift-certificates"> Gift Certificate</a>
                </li>
                <li>
                    <a href="/perks/gift-certificates/distribution"> GC Distribution</a>
                </li>
                <li>
                    <a href="/perks/foodstubs"> Food Stub</a>
                </li>
            </ul>
        </li>
        <!--
        <li @if (Request::is('teams/*')) class="active"@endif>
            <a href="/teams/status/1"><i class="fa fa-fw fa-users"></i> Team Status</a>
        </li>
        <li @if (Request::is('time/*')) class="active"@endif>
            <a href="/time"><i class="fa fa-fw fa-clock-o"></i> Time Records</a>
        </li>
        <li @if (Request::is('overtimes/*')) class="active"@endif>
            <a href="/overtimes"><i class="fa fa-history" aria-hidden="true"></i> Overtime Records</a>
        </li>
        <li @if (Request::is('leaves/*')) class="active"@endif>
            <a href="/leaves"><i class="fa fa-fw fa-plane"></i> Leave Records</a>
        </li>
        <li @if (Request::is('approvals/*')) class="active"@endif>
            <a href="/approvals"><i class="fa fa-thumbs-o-up"></i> Approvals</a>
        </li>
        <li @if (Request::is('settings/*')) class="active"@endif>
            <a href="javascript:;" data-toggle="collapse" data-target="#employee_settings" @if (Request::is('settings/*')) aria-expanded="true" @else class="collapsed" aria-expanded="false"@endif>
                <i class="fa fa-cog" aria-hidden="true"></i> Employee Settings <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="employee_settings" @if (Request::is('settings/*')) class="collapse in" aria-expanded="true"@else class="collapse" aria-expanded="false"@endif>
                <li>
                    <a href="/settings/employees">Employees</a>
                </li>
                <li>
                    <a href="/settings/teams">Teams</a>
                </li>
                <li>
                    <a href="/settings/employee-schedules">Employee Schedules</a>
                </li>
                <li>
                    <a href="/settings/emplooyee-leave-credits">Employee Leave Credits</a>
                </li>
                <li>
                    <a href="/settings/employee-time-logs">Time Logs</a>
                </li>

            </ul>
        </li>
        <li @if (Request::is('settings/*')) class="active"@endif>
            <a href="javascript:;" data-toggle="collapse" data-target="#company_settings" class="collapsed" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i> Company Settings <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="company_settings" class="collapse" aria-expanded="false">
                <li>
                    <a href="/settings/holidays"> Holidays</a>
                </li>
                <li>
                    <a href="/settings/leave-templates">Leave Templates</a>
                </li>
                <li>
                    <a href="/settings/ip-lockdown">IP Lockdown</a>
                </li>
                <li>
                    <a href="/announcements">Announcements</a>
                </li>
                <li>
                    <a href="/settings/departments">Departments</a>
                </li>
                <li>
                    <a href="/settings/site">Site</a>
                </li>
                <li>
                    <a href="/settings/configuration">Configuration</a>
                </li>
            </ul>
        </li>
        -->
    </ul>
</div>
@endif