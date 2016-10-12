<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeavesController extends Controller
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

        return view('leaves.index', ['data' => $data]);
    }

    public function getApply()
    {
        $data = [];

        return view('leaves.apply', ['data' => $data]);
    }
}
