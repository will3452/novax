<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dice = rand(0, 1);
        $type = null;
        $id = null;
        if ($dice) {
            $type = Exam::class;
            $id = Exam::inRandomOrder()->first()->id;
        } else {
            $type = Quiz::class;
            $id = Quiz::inRandomOrder()->first()->id;
        }
        return [
            'value' => $this->faker->sentence(10) . '?',
            'questionable_id' => $id,
            'questionable_type'=> $type,
        ];
    }
}
