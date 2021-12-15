<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $count = 0;
        foreach ($rows as $row) {
            $count ++;
            if($count != 1) {
                [$firstName, $lastName, $middleName] = explode(',', $row[1]);

                $courseId = Course::whereCode($row[5])->first() ? Course::whereCode($row[5])->first()->id: null;

                Student::updateOrCreate(['student_number'=>$row[0]],[
                    'student_number' => $row[0],
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'middle_name' => $middleName,
                    'address' => $row[2],
                    'gender' => $row[3],
                    'birthdate' => Carbon::parse($row[4], 'Asia/Manila'),
                    'course_id' => $courseId,
                ]);
            }

        }
    }
}
