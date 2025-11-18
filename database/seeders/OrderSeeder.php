<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $product_id = 1;
        $limit = 100;
        for($i = 0; $i < $limit; $i++) {
            $order = \App\Models\Order::create([
                'employee_id' => 2,
                'status' => \App\Models\Order::STATUS_CONFIRMED,
            ]);

            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'qty' => rand(1,40),
                'created_at' => $faker->dateTimeBetween('-5 years', 'now'),
            ]);
        }
    }
}
