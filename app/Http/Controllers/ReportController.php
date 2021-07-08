<?php

namespace App\Http\Controllers;

use App\Models\Report;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;

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
        $report = DB::table('reports')->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.index', compact('report'));
    }
    
    //menampilkan report status open saja
    public function open()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','open')->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.open', compact('report'));
    }
    
    //menampilkan report status ogp saja
    public function ogp()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','ogp')->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.ogp', compact('report'));
    }
    
    //menampilkan report status eskalasi saja
    public function eskalasi()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','eskalasi')->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.eskalasi', compact('report'));
    }

    //menampilkan report status closed saja
    public function closed()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','closed')->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.closed', compact('report'));
    }

    // export all data in excel
    public function export()
    {
        $filename = 'report_data_x'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new ReportExport, $filename);
    }

    //search berdasarkan nomor moban
    public function search(Request $request)
    {
        // menangkap data pencarian
        $search = $request->search;

        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
            ->where('report_number', 'like', "%" . $search . "%")
            ->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.index', ['report' => $report]);
    }

    //filter berdasarkan date range_all
    public function datefilter(Request $request)
    {       
        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
            ->where('updated_at', '>=', $request->from)
            ->where('updated_at', '<=', $request->to)
            ->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.index', ['report' => $report]);
    }

    public function datefilter_open(Request $request)
    {       
        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
            ->where('updated_at', '>=', $request->from)
            ->where('updated_at', '<=', $request->to)
            ->where('report_status','=','open')
            ->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.open', ['report' => $report]);
    }

    public function datefilter_ogp(Request $request)
    {       
        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
            ->where('updated_at', '>=', $request->from)
            ->where('updated_at', '<=', $request->to)
            ->where('report_status','=','ogp')
            ->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.ogp', ['report' => $report]);
    }

    public function datefilter_eskalasi(Request $request)
    {       
        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
            ->where('updated_at', '>=', $request->from)
            ->where('updated_at', '<=', $request->to)
            ->where('report_status','=','eskalasi')
            ->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.eskalasi', ['report' => $report]);
    }

    public function datefilter_closed(Request $request)
    {       
        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
            ->where('updated_at', '>=', $request->from)
            ->where('updated_at', '<=', $request->to)
            ->where('report_status','=','closed')
            ->simplePaginate(10);

        // mengirim data report ke view index
        return view('report.closed', ['report' => $report]);
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
        return redirect()->route('home')->with('success', 'Update Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */

    //delete method
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
