<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = Branch::get();
        $warehouses = [
            [
                'name' => 'Warehouse A',
                'Location' => 'Warehouse Location A',
            ],
            [
                'name' => 'Warehouse B',
                'Location' => 'Warehouse Location B',
            ],
            [
                'name' => 'Warehouse C',
                'Location' => 'Warehouse Location C',
            ],
        ];
        foreach ($branches as $branch) {
            foreach ($warehouses as $w) {
                $branch->warehouses()->create($w);
            }
        }
    }
}
