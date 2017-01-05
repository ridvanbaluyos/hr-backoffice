<?php
namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\LeaveTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class LeaveTemplatesController extends Controller
{
    /**
     * LeaveTemplatesController constructor.
     *
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
        $leaveTemplatesModel = new LeaveTemplates();
        $leaveTemplates = $leaveTemplatesModel::all()->keyBy('id')->toArray();
        $data['leave_templates'] = $leaveTemplates;

        return view('settings.leave-templates.index', ['data' => $data]);
    }

    public function getAdd()
    {
        $data['leave_template'] = null;

        return view('settings.leave-templates.add', ['data' => $data]);
    }

    public function postAdd(Request $request)
    {
        $leaveTemplateName = $request->input('name');
        $leaveTemplateCode = $request->input('code');
        $leaveTemplateDays = $request->input('days');
        $leaveTemplateAvailableTo = $request->input('available_to');
        $leaveTemplateAvailableGender = $request->input('available_gender');
        $leaveTemplateIsIncremental = $request->input('is_incremental');
        $leaveTemplateIsPaid = $request->input('is_paid');

        try {
            $leaveTemplatesModel = new LeaveTemplates();
            $leaveTemplatesModel->name = $leaveTemplateName;
            $leaveTemplatesModel->code = $leaveTemplateCode;
            $leaveTemplatesModel->days = $leaveTemplateDays;
            $leaveTemplatesModel->available_to = $leaveTemplateAvailableTo;
            $leaveTemplatesModel->available_gender = $leaveTemplateAvailableGender;
            $leaveTemplatesModel->is_incremental = $leaveTemplateIsIncremental;
            $leaveTemplatesModel->is_paid = $leaveTemplateIsPaid;
            $leaveTemplatesModel->created_by = Auth::user()->email;
            $leaveTemplatesModel->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', 'Leave Template Code: ' . $leaveTemplateCode . ' has been successfully added!');
        } catch(\Illuminate\Database\QueryException $e) {
            dd($e);
            switch ($e->getCode()) {
                case '23000':
                    $message = 'Leave Template Code: ' . $leaveTemplateCode . ' already exists.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/leave-templates');
    }

    public function getEdit($id)
    {
        $leaveTemplatesModel = new LeaveTemplates();
        $leaveTemplates = $leaveTemplatesModel->find($id)->toArray();
        $data['leave_template'] = $leaveTemplates;

        return view('settings.leave-templates.add', ['data' => $data]);
    }

    public function postEdit(Request $request, $id)
    {
        $leaveTemplateName = $request->input('name');
        $leaveTemplateCode = $request->input('code');
        $leaveTemplateDays = $request->input('days');
        $leaveTemplateAvailableTo = $request->input('available_to');
        $leaveTemplateAvailableGender = $request->input('available_gender');
        $leaveTemplateIsIncremental = $request->input('is_incremental');
        $leaveTemplateIsPaid = $request->input('is_paid');

        $leaveTemplatesModel = new LeaveTemplates();
        $leaveTemplate = $leaveTemplatesModel->find($id);

        try {
            $leaveTemplate->name = $leaveTemplateName;
            $leaveTemplate->code = $leaveTemplateCode;
            $leaveTemplate->days = $leaveTemplateDays;
            $leaveTemplate->available_to = $leaveTemplateAvailableTo;
            $leaveTemplate->available_gender = $leaveTemplateAvailableGender;
            $leaveTemplate->is_incremental = $leaveTemplateIsIncremental;
            $leaveTemplate->is_paid = $leaveTemplateIsPaid;
            $leaveTemplate->created_by = Auth::user()->email;
            $leaveTemplate->save();

            $request->session()->flash('alert-class', 'success');
            $request->session()->flash('alert-message', 'Leave Template Code: ' . $leaveTemplateCode . ' has been successfully updated!');
        } catch (\Illuminate\Database\QueryException $e) {
            switch ($e->getCode()) {
                case '23000':
                    $message = 'Employee #: ' . $employeeNumber . ' already exists.';
                    break;
                default:
                    $message = 'Something went wrong.';
                    break;
            }
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);
        }

        return redirect('settings/leave-templates');
    }

    public function ajaxDeleteLeaveTemplate(Request $request)
    {
        $id = $request->input('id');
        $leaveTemplate = LeaveTemplates::find($id);

        if (is_null($leaveTemplate)) {
            return json_encode(['status' => 'error']);
        } elseif ($leaveTemplate->delete()) {
            return json_encode(['status' => 'ok']);
        } else {
            return json_encode(['status' => 'error']);
        }
    }
}
