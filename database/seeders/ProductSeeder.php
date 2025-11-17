<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Ballpen',
                'price' => 15.00,
                'category' => Product::CATEGORY_SINGLE,
                'image' => null,
                'default_stock' => 100,
                'current_stock' => 100,
            ],
            [
                'name' => 'Notebook',
                'price' => 45.00,
                'category' => Product::CATEGORY_SINGLE,
                'image' => null,
                'default_stock' => 100,
                'current_stock' => 100,
            ],
            [
                'name' => 'Bond Paper (A4)',
                'price' => 350.00,
                'category' => Product::CATEGORY_SINGLE,
                'image' => null,
                'default_stock' => 100,
                'current_stock' => 100,
            ],
            [
                'name' => 'Marker Pen',
                'price' => 25.00,
                'category' => Product::CATEGORY_SINGLE,
                'image' => null,
                'default_stock' => 100,
                'current_stock' => 100,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
