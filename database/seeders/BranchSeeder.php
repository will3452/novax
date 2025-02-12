<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = [
            [
                'name' => 'Branch A',
                'address' => 'Location A',
                'phone' => '09121808887',
            ],
            [
                'name' => 'Branch B',
                'address' => 'Location B',
                'phone' => '09121807465',
            ]
        ];

        foreach ($branches as $b) {
            Branch::create($b);
        }
    }
}
