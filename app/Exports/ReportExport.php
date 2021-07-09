<?php

namespace App\Exports;

use App\Models\report;
use Facade\FlareClient\Report as FlareClientReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;


class ReportExport implements  FromView, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    // download db data in excel
    // public function collection()
    // {
    //     return Report::all()
    //     ->where('report_status', '==', 'closed');
    // }
    
    // download db data in excel by view
    public function view(): View
    {
        return view('report.index', [
            'report' => Report::all()
        ]);
    }


    // auto headings for excel file
    public function headings(): array
    {
        return [
            'ID',
            'Report Type',
            'Report Number',
            'Report Value',
            'Report Detail',
            'Report ID Sender',
            'Report Sender',
            'Report Status',
            'Open to OGP',
            'OGP to Eskalasi',
            'OGP to Closed',
            'Eskalasi to Closed',
            'Created at',
            'Updated at',
        ];
    }
}

