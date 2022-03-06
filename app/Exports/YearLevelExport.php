<?php

namespace App\Exports;

use App\Models\YearLevel;
use Maatwebsite\Excel\Concerns\FromCollection;

class YearLevelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return YearLevel::all();
    }
}
