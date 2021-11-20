<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids = Subject::get()->pluck('id')->toArray();
        return [
            'description' => $this->faker->sentence(),
            'code' => rand(1000, 9999),
            'subject_id' => $ids[$this->faker->numberBetween(0, count($ids) - 1)],
        ];
    }
}
