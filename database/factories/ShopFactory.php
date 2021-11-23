<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = null;

        $arr = explode('/', $image);
        $end = end($arr);

        $lat = [15.480780, 15.500085, 15.479572, 15.467330, 15.512657, 15.456079];
        $lng = [120.715970, 120.716292, 120.709764, 120.716635, 120.712169, 120.716292];
        $status = [Shop::STATUS_OPEN, SHOP::STATUS_CLOSED, SHOP::STATUS_OPEN];
        return [
            'user_id'=>1,
            'description'=>$this->faker->userName()."'s laundry shop",
            'address'=>$this->faker->address(),
            'contact_number'=>$this->faker->phoneNumber(),
            'contact_person'=> $this->faker->name(),
            'logo'=>$end,
            'lat'=>$lat[$this->faker->numberBetween(0,5)],
            'lng'=>$lng[$this->faker->numberBetween(0,5)],
            'status'=>$status[$this->faker->numberBetween(0,2)],
        ];
    }
}
