<?php

namespace App\Exports;

use App\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EskalasiExportByDate implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

        protected $from;
        protected $to;
    
        function __construct($from,$to) {
                $this->from = $from;
                $this->to = $to;
        }
    
        public function query()
        {
            $data = DB::table('reports')
                    ->whereDate('updated_at','<=',$this->to)
                    ->whereDate('updated_at','>=',$this->from)
                    ->where('report_status','=','eskalasi')
                    ->orderBy('id');
    
            return $data;
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
