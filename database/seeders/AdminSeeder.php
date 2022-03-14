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
        $superadmin = Role::create(['name'=>Role::SUPERADMIN]);
        $user = User::create([
            'name'=>'superadmin',
            'email'=>'super@admin.com',
            'password'=> bcrypt('password')
        ]);

        User::create([
            'name' => 'the teacher',
            'type' => User::TYPE_TEACHER,
            'email' => 'the@teacher.com',
            'password' => bcrypt('password'),
            'level' => User::LEVEL[0],
            'strand' => User::STRAND[0],
        ]);

        $user->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
