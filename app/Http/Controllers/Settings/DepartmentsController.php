<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Department;

class DepartmentsController extends Controller
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
        $departmentModel = new Department;
        $departments = $departmentModel::all();

        $data['departments'] = $departments;

        return view('settings.departments.index', ['data' => $data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $data = [];

        return view('settings.departments.add', ['data' => $data]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdd(Request $request)
    {
        $name = $request->input('department_name');
        $createdBy = Auth::user()->email;

        try {
            $departmentModel = new Department;
            $departmentModel->name = $name;
            $departmentModel->created_by = $createdBy;
            $departmentModel->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', $name . ' Department has been successfully added!');
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    $message = $name . ' department already exists.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/departments');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $departmentModel = new Department;
        $department = $departmentModel->find($id);

        $data = [];
        $data['department'] = $department;

        return view('settings.departments.add', ['data' => $data]);
    }

    public function postEdit(Request $request, $id)
    {
        $name = $request->input('department_name');

        try {
            $departmentModel = new Department;
            $department = $departmentModel->find($id);
            $department->name = $name;
            $department->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', $name . ' Department has been successfully updated!');
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    $message = $name . ' department already exists.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/departments');
    }

    public function ajaxDeleteDepartment(Request $request)
    {
        $id = $request->input('id');
        $department = Department::find($id);

        if (is_null($department)) {
            return json_encode(['status' => 'error']);
        } elseif ($department->delete()) {
            return json_encode(['status' => 'ok']);
        } else {
            return json_encode(['status' => 'error']);
        }
    }
}
