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
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=> bcrypt('password'),
            'type' => 'Admin',
        ]);

        User::create([
            'name' => 'the teacher',
            'type' => User::TYPE_TEACHER,
            'email' => 'the@teacher.com',
            'password' => bcrypt('password'),
            'level' => User::LEVEL[0],
            'strand' => User::STRAND[0],
        ]);
    }
}
