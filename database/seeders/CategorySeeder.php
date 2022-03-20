<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
                    "Vegetable",
                    "Fruit",
                    "Meat",
                    "Fish",
                    "Dairy",
                    "Poultry",
                    "Seeds",
                    "Plant",
                ];

            foreach ($lists as $list) {
                Category::create(['name' => $list]);
            }
    }
}
