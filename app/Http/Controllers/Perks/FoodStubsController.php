<?php
namespace App\Http\Controllers\Perks;

use App\Http\Controllers\Controller;
use App\LeaveTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class FoodStubsController extends Controller
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
        $data['foodstubs'] = [];

        return view('perks.foodstubs.index', ['data' => $data]);
    }
}