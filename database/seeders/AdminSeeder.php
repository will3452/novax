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
            'name'=>'Inventory Administrator',
            'email'=>'admin@yopmail.com',
            'password'=> bcrypt('password'),
            'role'=> User::ROLE_ADMIN,
            'quota'=>0,
            'verified_at'=>now()
        ]);
    }
}
