<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todaydate = Carbon::now()->format('Y-m-d');
        $report = \App\Models\Report::all();
        return view('home',compact('report'));
    }

    public function filter(Request $request)
    {
        $filter = $request->input('filterorder');

        $report = Report::query()
            ->where('report_type', 'LIKE', "%{$filter}%")
            ->get();

        return view('home', compact('report'));
    }
}
