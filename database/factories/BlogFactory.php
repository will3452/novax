<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(), 
            'user_id' => 1, 
            'tag' => $this->faker->sentence(3), 
            'body' => $this->faker->sentence(20), 
            'image' => "https://picsum.photos/seed/".$this->faker->word()."/600", 
        ];
    }
}
