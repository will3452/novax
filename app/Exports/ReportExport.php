<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Record;
use App\Models\RecordUserWorkingHour;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection, WithHeadings
{
    public $initYear;
    public $lastYear;

    public function __construct($initYear, $lastYear)
    {
        $this->initYear = $initYear ?? now();
        $this->lastYear = $lastYear ?? now();
    }

    public function getReport()
    {
        $arrayRecords  = [];
        $records = Record::whereBetween('created_at', [Carbon::parse($this->initYear), Carbon::parse($this->lastYear)])->get();
        foreach ($records as $key=>$record) {
            $arrayRecords[$key][0] = $record->customer_control_number;
            $arrayRecords[$key][1] = $record->company_control_number;
            $arrayRecords[$key][2] = $record->job_type;
            $arrayRecords[$key][3] = $record->job_status;
            $arrayRecords[$key][4] = $record->maker;
            $arrayRecords[$key][5] = $record->received_date;
            $arrayRecords[$key][6] = $record->customer_due_date;
            $arrayRecords[$key][7] = $record->company_due_date;
            $arrayRecords[$key][8] = $record->date_send;
            $arrayRecords[$key][9] = $record->status;
            $arrayRecords[$key][10] = $record->standard_time;
            $arrayRecords[$key][11] = RecordUserWorkingHour::where('record_id', $record->id)->sum('hour');
        }

        return $arrayRecords;
    }

    public function headings(): array
    {
        return [
            'CUSTOMER CONTROL NO.',
            'COMPANY CONTROL NO.',
            'JOB TYPE',
            'JOB STATUS',
            'MAKER',
            'RECEIVED DATE',
            'CUSTOMER DUE DATE',
            'COMPANY DUE DATE',
            'DATE SEND',
            'STATUS',
            'STANDARD TIME',
            'ACTUAL TIME',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return new Collection($this->getReport());
    }
}
