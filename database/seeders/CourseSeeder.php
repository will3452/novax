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
        $courses = [
            'BSIT',
            'BSCS',
            'BSCOE',
            'BSBA',
        ];

        foreach ($courses as $course) {
            Course::create([
                'name' => $course,
            ]);
        }

        info('Courses has been created!');
    }
}
