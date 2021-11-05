<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Product;
use App\Models\StockTake;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockTakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $inventory_discrepancies = [
            StockTake::INVENTORY_DESCREPANCY_SHRINKAGE,
            StockTake::INVENTORY_DESCREPANCY_HUMAN_ERROR,
            StockTake::INVENTORY_DESCREPANCY_MISMANAGED_RETURNS,
            StockTake::INVENTORY_DESCREPANCY_MISPLACED,
            StockTake::INVENTORY_DESCREPANCY_NONE
        ];
        return [
            'user_id'=>1,
            'location'=>Location::where('user_id', 1)->inRandomORder()->first()->name,
            'inventory_discrepancy'=>$inventory_discrepancies[$this->faker->numberBetween(0, 4)],
            'initial_number_of_stocks'=>$this->faker->numberBetween(5, 100),
            'current_physical_count' => $this->faker->numberBetween(1, 100),
            'product_id'=> Product::inRandomOrder()->first()->id,
            'created_at'=>$this->faker->dateTimeBetween('-5 years'),
        ];
    }
}
