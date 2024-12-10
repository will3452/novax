<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreOrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $products = Product::latest()->take(3)->get()->pluck('id')->all();
        return [
            'pre_order_id' => 1,
            'product_id' => $products[$this->faker->numberBetween(0, count($products) - 1)],
            'price' => 0,
            'quantity' => $this->faker->numberBetween(1, 100),
            'payable' => 0,
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
        ];
    }
}
