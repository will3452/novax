<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imagePath = storage_path('app/public');
        $savedImage = $this->faker->image($imagePath);
        $image = explode("\\", $savedImage);
        $image = end($image);
        return [
            'category_id' => 1,
            'description' => $this->faker->sentences(3),
            'image' => $image,
            'user_id' => 1,
            'status' => [Report::STATUS_NEW, Report::STATUS_DONE][$this->faker->numberBetween(0, 1)],
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->longitude(),
        ];
    }
}
