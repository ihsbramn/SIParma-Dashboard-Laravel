<?php

namespace App\Http\Controllers;

use App\Models\Report;
 
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengambil data dari table report
        $report = \App\Models\Report::paginate(10);

         // mengirim data report ke view index
        return view('report.index', compact ('report'));
    }


    // public function index()
	// {
    // 	        // mengambil data dari table pegawai
	// 	$pegawai = DB::table('pegawai')->paginate(10);
 
    // 	        // mengirim data pegawai ke view index
	// 	return view('index',['pegawai' => $pegawai]);
 
	// }

    public function export_excel()
	{
		return Excel::download(new ReportExport, 'Report.xlsx');
	}
    
    public function search(Request $request)
	{
		// menangkap data pencarian
        $search = $request->search;

        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
		->where('report_number','like',"%".$search."%")
		->paginate();

        // mengirim data report ke view index
		return view('report.index',['report' => $report]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return view('report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $report->update($request->all());
        return redirect()->route('home')->with('success','Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('home')
                        ->with('success','Deleted successfully');
    }
}
