<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                "name" => "Michelin Primacy 4",
                "price" => 12000,
                "category" => "Passenger Car Tires",
                "description" => "Premium tire offering excellent wet and dry grip with long-lasting performance."
            ],
            [
                "name" => "Bridgestone Dueler H/T 684",
                "price" => 9500,
                "category" => "SUV & 4x4 Tires",
                "description" => "All-season highway tire designed for SUVs with enhanced comfort and durability."
            ],
            [
                "name" => "Goodyear Wrangler AT/S",
                "price" => 10500,
                "category" => "All-Terrain Tires",
                "description" => "Versatile all-terrain tire with superior traction for off-road and highway driving."
            ],
            [
                "name" => "Pirelli Scorpion Verde",
                "price" => 11500,
                "category" => "Eco-Friendly Tires",
                "description" => "Fuel-efficient tire with low rolling resistance for SUVs and crossovers."
            ],
            [
                "name" => "Dunlop SP Sport LM705",
                "price" => 8700,
                "category" => "Performance Tires",
                "description" => "Comfortable and quiet ride with improved braking performance for city driving."
            ],
            [
                "name" => "Yokohama Geolandar A/T G015",
                "price" => 11000,
                "category" => "Off-Road Tires",
                "description" => "Durable off-road tire with excellent grip on various terrains and long tread life."
            ],
            [
                "name" => "Toyo Proxes T1 Sport",
                "price" => 9800,
                "category" => "Ultra-High Performance Tires",
                "description" => "High-performance tire with superior handling and stability at high speeds."
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
