<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sources = ['PRE-ORDER', 'ORDER'];
        return [
            'user_id' => 1,
            'total' => $this->faker->numberBetween(100, 50000),
            'source' => $sources[$this->faker->numberBetween(0, 1)],
            'source_id' => 1,
            'items' => [],
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
        ];
    }
}
