<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ["code" => "NCR", "name" => "National Capital Region"],
            ["code" => "CAR", "name" => "Cordillera Administrative Region"],
            ["code" => "Region I", "name" => "Ilocos Region"],
            ["code" => "Region II", "name" => "Cagayan Valley"],
            ["code" => "Region III", "name" => "Central Luzon"],
            ["code" => "Region IV-A", "name" => "CALABARZON"],
            ["code" => "MIMAROPA", "name" => "Southwestern Tagalog Region"],
            ["code" => "Region V", "name" => "Bicol Region"],
            ["code" => "Region VI", "name" => "Western Visayas"],
            ["code" => "Region VII", "name" => "Central Visayas"],
            ["code" => "Region VIII", "name" => "Eastern Visayas"],
            ["code" => "Region IX", "name" => "Zamboanga Peninsula"],
            ["code" => "Region X", "name" => "Northern Mindanao"],
            ["code" => "Region XI", "name" => "Davao Region"],
            ["code" => "Region XII", "name" => "SOCCSKSARGEN"],
            [
                "code" => "BARMM",
                "name" => "Bangsamoro Autonomous Region in Muslim Mindanao",
            ],
            ["code" => "Region XIII", "name" => "Caraga Region"],
        ];

        foreach ($regions as $region) {
            \App\Models\Region::create([
                "code" => $region["code"],
                "name" => $region["name"],
            ]);
        }
    }
}
