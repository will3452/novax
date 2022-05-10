<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentGradedExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Date',
            'Student Name',
            'Student Number',
            'Score',
        ];
    }

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $result = [];
        foreach ($this->data->getGraded() as $record) {
            array_push($result, [
                'date' => $record->created_at,
                'name' => $record->user->name,
                'LRN' => $record->user->number,
                'Score' => $record->score,
            ]);
        }
        return new Collection($result);
    }
}
