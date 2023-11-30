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
         

        $admin = User::create([
            'name'=>'Joselito Cruz',
            'email'=>'cruzjoselito345@gmail.com',
            'password'=> bcrypt('password')
        ]);

        User::create([
            'name'=>'Darwin Castro',
            'email'=>'darwincastrooo07@gmail.com',
            'password'=> bcrypt('password')
        ]);

        $admin->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
