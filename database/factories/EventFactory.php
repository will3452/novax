<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_at = $this->faker->numberBetween(1, 10); 
        $end_at = $start_at + 3; 
        return [
            'name' => $this->faker->sentence(5),
            'description' => $this->faker->sentence(20),
            'start_at' => now()->addDays($start_at),
            'end_at' => now()->addDays($end_at), 
        ];
    }
}
