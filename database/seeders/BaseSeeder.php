<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categories

        $names = ['Computers', 'Components', 'Peripherals', 'Accessories'];

        foreach ($names as $value) {
            Category::create([
                'name' => $value,
                'description' => 'lorem ipsum dolor set.',
            ]);
        }

        // images



    }
}
