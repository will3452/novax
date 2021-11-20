<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $moduleIds = Module::get()->pluck('id')->toArray();
        return [
            'description' => $this->faker->sentence(),
            'module_id' => $moduleIds[$this->faker->numberBetween(0, count($moduleIds) - 1)]
        ];
    }
}
