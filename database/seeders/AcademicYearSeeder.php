<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academicYear = AcademicYear::create([
            'year' => '2023-2024',
            'is_active' => true,
        ]);

        info("Academic year has been seed.");
    }
}
