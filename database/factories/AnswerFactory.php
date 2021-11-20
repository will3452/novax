<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids = Question::get()->pluck('id')->toArray();
        $dice = rand(0, 1);
        if ($dice) {
            $type = Answer::TYPE_CORRECT;
        } else {
            $type = Answer::TYPE_WRONG;
        }
        return [
            'question_id' => $ids[$this->faker->numberBetween(0, count($ids) - 1)],
            'value' => $this->faker->sentence(3) . "($type)",
            'type' => $type
        ];
    }
}
