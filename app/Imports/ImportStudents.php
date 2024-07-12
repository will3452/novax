<?php

namespace App\Imports;

use App\Models\SectionStudent;
use App\Models\User;
use App\Nova\ClassInvitation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportStudents implements ToModel, WithHeadingRow
{
    public $sectionId; 

    public function __construct(int $sectionId)
    {
        $this->sectionId = $sectionId; 
    }
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $student = User::whereNumber($row['id_no'])->whereType('Student')->first();
        if (! $student) return; 
        return SectionStudent::create([
            'section_id' => $this->sectionId, 
            'student_id' => $student->id, 
            'status' => 'JOINED', 
        ]); 
    }

    public function headingRow(): int
    {
        return 1;
    }
}
