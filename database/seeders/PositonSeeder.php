<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = ["IT Head", "IT Staff", "HR Head", "HR Staff", "Finance Head", "Finance Staff", "Sales Manager", "Sales Staff", "Legal Head", "Legal Staff", "Security Head", "Security Staff", "Administrative Head", "Administrative Staff", "Accounting Head", "Accounting Staff", "Marketing Head", "Marketing Staff", "Customer Service Head", "Customer Service Staff"];
        foreach ($positions as $p) {
            Position::create(['description' => $p]);
        }
    }
}
