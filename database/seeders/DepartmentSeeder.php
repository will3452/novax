<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ["Information Technology Department", "Human Resource Department", "Finance Department", "Sales Department", "Legal Department", "Security Department", "Administrative Department", "Accounting Department", "Marketing Department", "Customer Service Department"];

        foreach ($departments as $d) {
            Department::create(['name' => $d]);
        }
    }
}
