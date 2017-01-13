<?php
namespace App\Http\Controllers\Perks;

use App\Http\Controllers\Controller;
use App\Department;
use App\EmployeeInformation;
use App\GiftCertificates;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Carbon\Carbon;


class GiftCertificatesController extends Controller
{
    /**
     * LeaveTemplatesController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['apiGetPerksGiftCertificates', 'apiGetUserPerksGiftCertificates', 'apiPostPerksGiftCertificates']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $id = Auth::user()->id;
        $data['gc'] = GiftCertificates::where('employee_id', $id)->get()->toArray();
        $data['gift_certificates'] = config('formvalues.gift_certificates');
        $data['months'] = $this->getMonthNames();

        return view('perks.gift-certificates.index', ['data' => $data]);
    }

    public function postIndex(Request $request, $id)
    {
        $giftCertificates = $request->input('gift_certificate');
        $year = date('Y');
        $createdBy = Auth::user()->email;

        if (is_null($giftCertificates)) {
            $message = 'Something went wrong.';
            $request->session()->flash('alert-class', 'danger');
            $request->session()->flash('alert-message', $message);

            return redirect('perks/gift-certificates');
        }

        try {
            foreach ($giftCertificates as $month=>$perk) {
                $monthYear = Carbon::createFromDate($year, $month, 1, 'Asia/Manila')->format('Y-m-d');

                $giftCertificate = DB::table('perks_gift_certificates')->where('employee_id', '=', $id)->where('month_year', '=', $monthYear)->where('status', '=', 'submitted');

                if ($giftCertificate->get()->isEmpty()) {
                    $giftCertificateModel = new GiftCertificates();
                    $giftCertificateModel->employee_id = $id;
                    $giftCertificateModel->month_year = $monthYear;
                    $giftCertificateModel->perk = $perk;
                    $giftCertificateModel->status = 'submitted';
                    $giftCertificateModel->created_by = $createdBy;
                    $giftCertificateModel->save();
                } else {
                    $giftCertificate->update([
                        'month_year' => $monthYear,
                        'perk' => $perk
                    ]);
                }
            }

            return redirect('perks/gift-certificates');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            switch ($e->getCode()) {
                case '23000':
                    break;
                default:
                    break;
            }
        }

    }

    public function getDistribution()
    {
        $data = [];
        $monthYear = Carbon::createFromDate(date('Y'), date('m'), 1, 'Asia/Manila')->format('Y-m-d');
        $data['gc'] = GiftCertificates::where('month_year', '=', $monthYear)->paginate(15);
        $data['gift_certificates'] = config('formvalues.gift_certificates');
        $data['months'] = $this->getMonthNames();

        $teamModel = new Team();
        $teams = $teamModel::all()->keyBy('id')->toArray();
        $data['teams'] = $teams;

        $departmentModel = new Department();
        $departments = $departmentModel::all()->keyBy('id')->toArray();
        $data['departments'] = $departments;

        return view('perks.gift-certificates.distribution', ['data' => $data]);
    }

    public function postDistribution(Request $request)
    {
        $month = $request->input('month');
        $giftCertificate = $request->input('gift_certificate');
        $department = $request->input('department');
        $team = $request->input('team');
        $lastname = $request->input('lastname');

        $monthYear = Carbon::createFromDate(date('Y'), $month, 1, 'Asia/Manila')->format('Y-m-d');

        $giftCertificates = GiftCertificates::where('month_year', '=', $monthYear);
        $request->session()->flash('month', $month);

        if ($giftCertificate != 'all') {
            $giftCertificates = $giftCertificates->where('perk', '=', $giftCertificate);
            $request->session()->flash('perk', $giftCertificate);
        }

        if ($department != 'all') {
//            $giftCertificates = $giftCertificates->where('department_id', '=', $department);
//            $request->session()->flash('department', $department);
        }
        if ($team != 'all') {

        }

        if ($lastname != '') {

        }

        $giftCertificates = $giftCertificates->paginate(15);

        $data['gc'] = $giftCertificates;

        $data['gift_certificates'] = config('formvalues.gift_certificates');
        $data['months'] = $this->getMonthNames();

        $teamModel = new Team();
        $teams = $teamModel::all()->keyBy('id')->toArray();
        $data['teams'] = $teams;

        $departmentModel = new Department();
        $departments = $departmentModel::all()->keyBy('id')->toArray();
        $data['departments'] = $departments;



        return view('perks.gift-certificates.distribution', ['data' => $data]);
    }

    public function putRedeemGiftCertificate(Request $request)
    {
        try {
            $perk = $request->input('perk');
            $month = $request->input('month');
            $id = $request->input('id');

            $giftCertificate = DB::table('perks_gift_certificates')->where('perk', '=', $perk)->where('month_year', '=', $month)->where('employee_id', '=', $id);
            $giftCertificate->update([
                'status' => 'redeemed',
            ]);
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

    public function apiGetPerksGiftCertificates(Request $request)
    {
        $token = $request->input('access_token');

        if ($token != 'bd0651402ab02944d4aeabd3471e19f1d34678be') {
            return response(['status' =>  'unauthorized'], 401)
                ->header('Content-Type', 'text/json');
        } else {
            $perks = config('formvalues.gift_certificates');
            $data = json_encode([
                'status' => 'ok',
                'data' => $perks
            ]);

            return response($data, 200)
                ->header('Content-Type', 'text/json');
        }
    }

    public function apiGetUserPerksGiftCertificates(Request $request, $id)
    {
        $token = $request->input('access_token');

        if ($token != 'bd0651402ab02944d4aeabd3471e19f1d34678be') {
            return response(['status' =>  'unauthorized'], 401)
                ->header('Content-Type', 'text/json');
        } else {
            $employeeId = $request->input('employee_id');
            $monthYear = $request->input('month_year');
            $perk = $request->input('perk');

            $giftCertificate = DB::table('perks_gift_certificates')->where('employee_id', '=', $id); //->where('month_year', '=', $monthYear)->where('status', '=', 'submitted')->get()->toArray();

            if (!is_null($monthYear)) {
                $giftCertificate = $giftCertificate->where('month_year', '=', $monthYear);
            }

            if (!is_null($perk)) {
                $giftCertificate = $giftCertificate->where('perk', '=', $perk);
            }

            $giftCertificate = $giftCertificate->get()->toArray();

            $data = json_encode([
                'status' => 'ok',
                'data' => $giftCertificate
            ]);

            return response($data, 200)
                ->header('Content-Type', 'text/json');
        }
    }

    public function apiPostPerksGiftCertificates(Request $request, $id)
    {
        $token = $request->input('access_token');

        if ($token != 'bd0651402ab02944d4aeabd3471e19f1d34678be') {
            return response(['status' =>  'unauthorized'], 401)
                ->header('Content-Type', 'text/json');
        } else {
            $employeeId = $request->input('employee_id');
            $monthYear = $request->input('month_year');
            $perk = $request->input('perk');

            $giftCertificate = DB::table('perks_gift_certificates')->where('employee_id', '=', $id)->where('month_year', '=', $monthYear)->where('status', '=', 'submitted');

            if ($giftCertificate->get()->isEmpty()) {
                $giftCertificateModel = new GiftCertificates();
                $giftCertificateModel->employee_id = $id;
                $giftCertificateModel->month_year = $monthYear;
                $giftCertificateModel->perk = $perk;
                $giftCertificateModel->status = 'submitted';
                $giftCertificateModel->created_by = 'skuizon@olx.ph';
                $giftCertificateModel->save();

                $data = json_encode([
                    'status' => 'ok',
                ]);

                return response($data, 200)
                    ->header('Content-Type', 'text/json');
            } else {
                $data = json_encode([
                    'status' => 'submitted',
                ]);

                return response($data, 304)
                    ->header('Content-Type', 'text/json');
            }
        }
    }

    /**
     * @return array
     *
     */
    protected function getMonthNames()
    {
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $months[$m] = $month;
        }
        return $months;
    }
}