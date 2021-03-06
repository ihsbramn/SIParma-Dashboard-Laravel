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
use Carbon\Carbon;

use SebastianBergmann\CodeCoverage\Report\Xml\Report as XmlReport;

class ReportExport implements FromCollection, WithHeadings{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return Report::all();
    }
    
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
            'sender_name',
            'Report Status',
            'Open to OGP',
            'OGP to Eskalasi',
            'OGP to Closed',
            'Eskalasi to Closed',
            'Open to Ogp time',
            'Ogp to Eskalasi Time',
            'Ogp to Closed Time',
            'Eskalasi to Closed Time',
            'Created at',
            'Updated at',
        ];
    }
}

