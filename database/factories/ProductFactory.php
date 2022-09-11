<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $filepath = storage_path('products');

            if(!File::exists($filepath)){
                File::makeDirectory($filepath);
            }
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(150,9999),
            'image' => $this->faker->image($filepath,480, 640),
            'description' => $this->faker->sentence(6),
            'category' => Category::inRandomOrder()->first()->name,
            'status' => Product::STATUS_AVAILABLE,
        ];
    }
}
