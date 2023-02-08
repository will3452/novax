<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'System Administrator',
            'email'=>'ad@min.com',
            'password'=> bcrypt('password'),
            'type'=> User::TYPE_ADMIN,
            'phone' => '',
            'verified_at' => now(),
        ]);
    }
}
