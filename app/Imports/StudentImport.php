<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{

    public $branchId;
    public function __construct($branchId)
    {
        $this->branchId = $branchId;
    }

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
                $guardian = $row[7] ?? '';
                $mobileNumber = $row[6] ?? '';
                $guardian_address = $row[8] ?? '';
                $guardian_mobile_number = $row[9] ?? '';
                Student::updateOrCreate(['student_number'=>$row[0]],[
                    'student_number' => $row[0],
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'middle_name' => $middleName,
                    'address' => $row[2],
                    'gender' => $row[3],
                    'birthdate' => $row[4],
                    'course_id' => $courseId,
                    'branch_id' => $this->branchId,
                    'mobile_number' => $mobileNumber,
                    'guardian' => $guardian,
                    'guardian_address' => $guardian_address,
                    'guardian_mobile_number' =>  $guardian_mobile_number,
                ]);
            }

        }
    }
}
