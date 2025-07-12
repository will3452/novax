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
            'name'=>'The Administrator',
            'email'=>'root@yopmail.com',
            'username'=>'admin',
            'organization_id' => null, // Assuming no organization for the admin
            'role' => 'ADMIN', // Setting the role to ADMIN
            'password'=> bcrypt('password')
        ]);
    }
}
