<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = ['1st sem', '2nd sem', 'summer'];
        foreach ($semesters as $semester) {
            Semester::create(['semester' => $semester]);
        }
    }
}
