<?php

namespace Database\Seeders;

use App\Models\SmsBalance;
use Illuminate\Database\Seeder;

class SmsBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmsBalance::create([
            'amount' => 250, 
        ]); 
    }
}
