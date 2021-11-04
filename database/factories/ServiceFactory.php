<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shop = Shop::inRandomOrder()->first();
        $status = [Service::STATUS_AVAILABLE, Service::STATUS_NOT_AVAILABLE, Service::STATUS_AVAILABLE];
        return [
            'shop_id'=>$shop->id,
            'description'=>$this->faker->word(),
            'cost'=>$this->faker->numberBetween(20,50),
            'remarks'=>$this->faker->paragraph(),
            'status'=>$status[$this->faker->numberBetween(0,2)],
        ];
    }
}
