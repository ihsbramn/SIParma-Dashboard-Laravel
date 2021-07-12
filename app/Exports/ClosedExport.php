<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClosedExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Report::all()
        ->where('report_status','==','closed');
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
