<?php
namespace App\Http\Controllers\Settings;

use App\EmployeeInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Team;
use App\Department;
use App\TeamManager;
use App\TeamMember;

class TeamsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data = [];
        $teamModel = new Team;
        $teams = $teamModel::all()->toArray();

        $departmentModel = new Department;
        $departments = $departmentModel::all()->keyBy('id')->toArray();

        $data['teams'] = $teams;
        $data['departments'] = $departments;

        return view('settings.teams.index', ['data' => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $data = [];
        $departmentModel = new Department;
        $departments = $departmentModel::all()->keyBy('id');

        $data['departments'] = $departments;

        return view('settings.teams.add', ['data' => $data]);
    }

    public function postAdd(Request $request)
    {
        $name = $request->input('team_name');
        $department = $request->input('team_department');
        $createdBy = Auth::user()->email;

        try {
            $teamModel = new Team;
            $teamModel->name = $name;
            $teamModel->department_id = $department;
            $teamModel->created_by = $createdBy;
            $x = $teamModel->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', $name . ' Team has been successfully added!');
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    $message = $name . ' team already exists in the department chosen.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/teams');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data = [];

        $teamModel = new Team;
        $team = $teamModel->find($id);
        $data['team'] = $team;

        $teamManagersModel = new TeamManager();
        $teamManagers = $teamManagersModel::where('team_id', $id)->get();
        if ($teamManagers->isEmpty()) {
            $data['teamManagers'] = [];
        } else {
            $data['teamManagers'] = $teamManagers;
        }

        $departmentModel = new Department;
        $departments = $departmentModel::all()->keyBy('id');
        $data['departments'] = $departments;

        $employeeInformationModel = new EmployeeInformation();
        $teamMembers = $employeeInformationModel->where('team_id', $id)->get()->toArray();
        $data['teamMembers'] = $teamMembers;

        return view('settings.teams.add', ['data' => $data]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(Request $request, $id)
    {
        $name = $request->input('team_name');
        $department = $request->input('team_department');

        try {
            $teamModel = new Team;
            $team = $teamModel->find($id);
            $team->name = $name;
            $team->department_id = $department;
            $team->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', $name . ' Department has been successfully updated!');
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    $message = $name . ' team already exists.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/teams');
    }

    public function ajaxPutTeamManager(Request $request)
    {
        $team = $request->input('team');
        $manager = $request->input('manager');

        try {
            $createdBy = Auth::user()->email;

            $teamManagerModel = new TeamManager();
            $teamManagerModel->employee_id = $manager;
            $teamManagerModel->team_id = $team;
            $teamManagerModel->created_by = $createdBy;
            $teamManagerModel->save();

            return json_encode(['status' => 'ok']);
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    return json_encode(['status' => 'duplicate']);
                    break;
                default:
                    return json_encode(['status' => 'error']);
                    break;
            }
        }
    }

    public function ajaxDeleteTeamManager(Request $request)
    {
        $id = $request->input('id');
        $teamManager = TeamManager::where('employee_id', $id)->first();

        if (is_null($teamManager)) {
            return json_encode(['status' => 'error']);
        } elseif ($teamManager->delete()) {
            return json_encode(['status' => 'ok']);
        } else {
            return json_encode(['status' => 'error']);
        }
    }

    public function ajaxPutTeamMember(Request $request)
    {
        $team = $request->input('team');
        $member = $request->input('member');

        try {
            $createdBy = Auth::user()->email;

            // Employee Information
            $employeeInformationModel = new EmployeeInformation();
            $employee = $employeeInformationModel->find($member);

            $employee->team_id = $team;
            $employee->save();

            return json_encode(['status' => 'ok']);
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    return json_encode(['status' => 'duplicate']);
                    break;
                default:
                    return json_encode(['status' => 'error']);
                    break;
            }
        }
    }

    public function ajaxDeleteTeamMember(Request $request)
    {
        $member = $request->input('id');

        try {
            $createdBy = Auth::user()->email;

            // Employee Information
            $employeeInformationModel = new EmployeeInformation();
            $employee = $employeeInformationModel->find($member);
            $employee->team_id = 0;

            $employee->save();

            return json_encode(['status' => 'ok']);
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    return json_encode(['status' => 'duplicate']);
                    break;
                default:
                    return json_encode(['status' => 'error']);
                    break;
            }
        }
    }

    public function ajaxDeleteTeam(Request $request)
    {
        $id = $request->input('id');
        $team = Team::find($id);
        $teamManager = TeamManager::where('employee_id', $id);

        if (is_null($team)) {
            return json_encode(['status' => 'error']);
        } elseif ($team->delete()) {
            $teamManager->delete();
            return json_encode(['status' => 'ok']);
        } else {
            return json_encode(['status' => 'error']);
        }
    }
}
