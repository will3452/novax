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
            'last_name'=>'super',
            'first_name'=>'admin',
            'middle_name'=>'s',
            'type' => User::TYPE_ADMIN,
            'email'=>'super@admin.com',
            'password'=> bcrypt('password')
        ]);
    }
}
