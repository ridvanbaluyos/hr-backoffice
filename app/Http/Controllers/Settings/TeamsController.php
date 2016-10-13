<?php
namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        return view('settings.teams.index', ['data' => $data]);
    }

    public function getAdd()
    {
        $data = [];

        return view('settings.teams.add', ['data' => $data]);
    }
}
