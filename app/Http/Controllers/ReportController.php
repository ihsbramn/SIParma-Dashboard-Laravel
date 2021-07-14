<?php

namespace App\Http\Controllers;

use App\Models\Report;

use App\Exports\ReportExport;
use App\Exports\OpenExport;
use App\Exports\OgpExport;
use App\Exports\EskalasiExport;
use App\Exports\ClosedExport;
use Carbon\Carbon;
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
        $report = DB::table('reports')->paginate(10);

        // mengirim data report ke view index
        return view('report.index', compact('report'));
    }
    
    //menampilkan report status open saja
    public function open()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','open')->paginate(10);

        // mengirim data report ke view index
        return view('report.open', compact('report'));
    }
    
    //menampilkan report status ogp saja
    public function ogp()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','ogp')->paginate(10);

        // mengirim data report ke view index
        return view('report.ogp', compact('report'));
    }
    
    //menampilkan report status eskalasi saja
    public function eskalasi()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','eskalasi')->paginate(10);

        // mengirim data report ke view index
        return view('report.eskalasi', compact('report'));
    }

    //menampilkan report status closed saja
    public function closed()
    {
        // mengambil data dari table report
        $report = Report::where('report_status','=','closed')->paginate(10);

        // mengirim data report ke view index
        return view('report.closed', compact('report'));
    }

    // export all data in excel
    public function export(Request $request)
    {
        $filename = 'report_data_'.date('Y-m-d_H:i:s').'.xlsx';
        // return Excel::download(new ReportExport, $filename);
        $from_date=$request->from;
        $to_date = $request->to;


         return Excel::download(new ReportExport($from_date,$to_date), $filename);
    }
    
    // export open data in excel
    public function exportopen()
    {
        $filename = 'report_data_open_'.date('Y-m-d_H:i:s').'.xlsx';
        return Excel::download(new OpenExport, $filename);
    }
    
    // export ogp data in excel
    public function exportogp()
    {
        $filename = 'report_data_ogp_'.date('Y-m-d_H:i:s').'.xlsx';
        return Excel::download(new OgpExport, $filename);
    }
    
    // export eskalasi data in excel
    public function exporteskalasi()
    {
        $filename = 'report_data_eskalasi_'.date('Y-m-d_H:i:s').'.xlsx';
        return Excel::download(new EskalasiExport, $filename);
    }
    
    // export closed data in excel
    public function exportclosed()
    {
        $filename = 'report_data_closed_'.date('Y-m-d_H:i:s').'.xlsx';
        return Excel::download(new ClosedExport, $filename);
    }

    //search berdasarkan nomor moban
    public function search(Request $request)
    {
        // menangkap data pencarian
        $search = $request->search;

        // mengambil data dari table report sesuai pencarian data
        $report = DB::table('reports')
            ->where('report_number', 'like', "%" . $search . "%")
            ->paginate(10);

        // mengirim data report ke view index
        return view('report.index', ['report' => $report]);
    }

    //filter berdasarkan date range_all
    public function datefilter(Request $request)
    {   
        //validating    
        // $this->validate($request,[
        //         'from' => 'required|date',
        //         'to' => 'required|date|before_or_equal:from',
        //        ]);
        
        //change db to carbon
        $start = Carbon::parse($request->from);
        $end = Carbon::parse($request->to);
        
        //filtering
        $report = report::whereDate('updated_at','<=',$end->format('y-m-d'))
            ->whereDate('updated_at','>=',$start->format('y-m-d'))
            ->paginate(10);
        
        // mengirim data report ke view index
        return view('report.index', ['report' => $report]);
    }

    public function datefilter_open(Request $request)
    {   
        // //validating    
        // $this->validate($request,[
        //         'from' => 'required|date',
        //         'to' => 'required|date|before_or_equal:from',
        //        ]);
        
        //change db to carbon
        $start = Carbon::parse($request->from);
        $end = Carbon::parse($request->to);
        
        //filtering
        $report = report::whereDate('updated_at','<=',$end->format('y-m-d'))
            ->whereDate('updated_at','>=',$start->format('y-m-d'))
            ->where('report_status','=','open')
            ->paginate(10);   

        // mengirim data report ke view index
        return view('report.open', ['report' => $report]);
    }

    public function datefilter_ogp(Request $request)
    {   
        // //validating    
        // $this->validate($request,[
        //         'from' => 'required|date',
        //         'to' => 'required|date|before_or_equal:from',
        //        ]);
        
        //change db to carbon
        $start = Carbon::parse($request->from);
        $end = Carbon::parse($request->to);
        
        //filtering
        $report = report::whereDate('updated_at','<=',$end->format('y-m-d'))
            ->whereDate('updated_at','>=',$start->format('y-m-d'))
            ->where('report_status','=','ogp')
            ->paginate(10);

        // mengirim data report ke view index
        return view('report.ogp', ['report' => $report]);
    }

    public function datefilter_eskalasi(Request $request)
    {       
        // //validating    
        // $this->validate($request,[
        //         'from' => 'required|date',
        //         'to' => 'required|date|before_or_equal:from',
        //        ]);
        
        //change db to carbon
        $start = Carbon::parse($request->from);
        $end = Carbon::parse($request->to);
        
        //filtering
        $report = report::whereDate('updated_at','<=',$end->format('y-m-d'))
            ->whereDate('updated_at','>=',$start->format('y-m-d'))
            ->where('report_status','=','eskalasi')
            ->paginate(10);

        // mengirim data report ke view index
        return view('report.eskalasi', ['report' => $report]);
    }

    public function datefilter_closed(Request $request)
    {       
        // //validating    
        // $this->validate($request,[
        //         'from' => 'required|date',
        //         'to' => 'required|date|before_or_equal:from',
        //        ]);
        
        //change db to carbon
        $start = Carbon::parse($request->from);
        $end = Carbon::parse($request->to);
        
        //filtering
        $report = report::whereDate('updated_at','<=',$end->format('y-m-d'))
            ->whereDate('updated_at','>=',$start->format('y-m-d'))
            ->where('report_status','=','closed')
            ->paginate(10);

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
