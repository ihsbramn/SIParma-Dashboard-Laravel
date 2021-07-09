<?php

namespace App\Exports;

use App\Models\report;
use Maatwebsite\Excel\Concerns\FromCollection;

class OpenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
        // download db data in excel
    public function collection()
    {
        return Report::all()
        ->where('report_status','==','open');
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
