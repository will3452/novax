<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(), 
            'description' => $this->faker->sentence(6),
            'requirements' => implode(", ", explode(' ', $this->faker->sentence(5))),
            'slot' => $this->faker->numberBetween(1, 10),
            'image' =>  "https://picsum.photos/seed/".$this->faker->word()."/600", 
        ];
    }
}
