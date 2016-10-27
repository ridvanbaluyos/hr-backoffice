<?php
namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Team;
use App\Department;

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
        $teamModel = new Team;
        $team = $teamModel->find($id);

        $departmentModel = new Department;
        $departments = $departmentModel::all()->keyBy('id');

        $data['departments'] = $departments;
        $data['team'] = $team;


        return view('settings.teams.add', ['data' => $data]);
    }

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
}
