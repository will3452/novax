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
            'first_name'=>'system',
            'last_name'=>'administrator',
            'middle_name'=>'  ',
            'email'=>'super@admin.com',
            'birthdate' => '2000-03-04',
            'gender' => 'male',
            'password'=> bcrypt('password')
        ]);

        $user->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
