<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coursesCode = ['BSIT', 'BSCS', 'BSCE'];
        $courseDescription = [
            'BS. information technology',
            'BS. Computer Science',
            'BS. Computer Engineering',
        ];

        for ($i = 0; $i < count($coursesCode); $i++) {
            Course::create([
                'code'=>$coursesCode[$i],
                'description'=>$courseDescription[$i]
            ]);
        }
    }
}
