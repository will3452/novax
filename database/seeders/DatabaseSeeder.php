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

        $this->call([
            AdminSeeder::class,
            // AssetSeeder::class,
            // ProductSeeder::class,
            // LocationSeeder::class,
            // StockTakeSeeder::class,
        ]);
    }
}
