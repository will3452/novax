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
            'password'=> bcrypt('password'),
            'type' => User::TYPE_ADMINISTRATOR, 
        ]);

        $backup = User::create([
            'name'=>'backup',
            'email'=>'buckup@admin.com',
            'password'=> bcrypt('password'),
            'type' => User::TYPE_ADMINISTRATOR, 
        ]);

        $backup->assignRole($superadmin);
        $user->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
