<?php

namespace Database\Seeders;

use App\Models\TypeOfAccount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            // AssetSeeder::class,
            // ProductSeeder::class,
            // LocationSeeder::class,
            StockTakeSeeder::class,
        ]);

        $typesOfAccounts = [
            'ASSETS (current)',
            'ASSETS (non current)',
            'LIABILITIES (current)',
            'LIABILITIES (non current)',
            'CAPITAL',
            'REVENUE',
            'EXPENSES'
        ];

        foreach ($typesOfAccounts as $account) {
            TypeOfAccount::create([
                'name'=>$account
            ]);
        }
    }
}
