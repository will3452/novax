<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Support\Str;
use App\Helpers\ReferenceHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subject = ['English', 'Math', 'PE', 'Filipino', 'GMRC'];
        return [
            'reference_number'=>ReferenceHelper::generate('SUB', Subject::count() + 1),
            'description'=> $subject[$this->faker->numberBetween(0, count($subject) - 1)],
            'code'=>Str::random(6),
        ];
    }
}
