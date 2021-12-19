<?php

namespace Database\Factories;

use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employer_id' => User::factory(),
            'position' => $this->faker->jobTitle(),
            'description' => $this->faker->sentences(5, true),
            'salary' => 4000,
            'slot' => 120,
            'ended_at' => now()->addDays(30),
            'status' => JobOffer::STATUS_OPEN,
            'urgent' => true,
        ];
    }
}
