<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>1,
            'description'=>$this->faker->words(3, true),
            'purchase_date'=>now()->addDays(random_int(1, 100))->format('Y-m-d'),
            'purchase_cost'=>$this->faker->numberBetween(100, 10000),
            'location'=>$this->faker->address(),
            'owner'=>$this->faker->name(),
            'users'=>$this->faker->name(),
            'serial_number'=>$this->faker->randomNumber(4),
            'insurance_coverage'=>$this->faker->words(3, true),
            'current_value'=>$this->faker->numberBetween(100, 9000),
            'depreciation_method_used'=>$this->faker->words(3, true),
            'manufacturers_warranty'=>$this->faker->words(2, true),
            'maintenance_information'=>$this->faker->phoneNumber(),
            'life_expectancy'=>$this->faker->words(2, true),
            'estimated_resale_value'=>$this->faker->numberBetween(100, 9000),
        ];
    }
}
