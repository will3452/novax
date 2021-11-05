<?php

namespace Database\Seeders;

use App\Models\StockTake;
use Illuminate\Database\Seeder;

class StockTakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockTake::factory(30)->create();
    }
}
