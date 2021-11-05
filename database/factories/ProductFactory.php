<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codes'=>Str::random(8),
            'name'=>$this->faker->word(),
            'description'=>$this->faker->sentence(3),
            'unit_cost'=>$this->faker->numberBetween(5, 1000),
            'selling_price'=>$this->faker->numberBetween(200, 2000),
            'stocks'=>$this->faker->numberBetween(1, 250),
        ];
    }
}
