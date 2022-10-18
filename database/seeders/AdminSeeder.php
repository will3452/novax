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
            'name'=>'superadmin',
            'email'=>'super@admin.com',
            'password'=> bcrypt('password'),
            'phone' => '09121808887',
            // 'phone' => '09058656526',
            'type' => User::TYPE_ADMIN,
        ]);
    }
}
