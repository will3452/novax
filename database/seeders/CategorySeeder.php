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
        $categories = [
            'Transactional Document',
            'Emails',
            'Business Letters',
            'Financial Reports',
        ];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
