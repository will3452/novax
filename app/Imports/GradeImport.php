<?php

namespace App\Imports;

use App\Models\Profile;
use App\Models\StudentRecord;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GradeImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $number = $row['student_no'];
        $sCode = $row['subject_code'];
        $grade = $row['final_grade'];

        $profile = Profile::whereNumber($number)->first();

        if (!$profile) {
            return null;
        }

        $subject = Subject::whereCode($sCode)->first();

        if (!$subject) {
            return null;
        }

        return new StudentRecord([
            'legacy' => true,
            'subject_id' => $subject->id,
            'student_id' => $profile->user_id,
            'total_grade' => $grade,
        ]);
    }
}
