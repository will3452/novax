<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create(['name' => Role::SUPERADMIN]);
        $user = User::create([
            'name' => 'police admin',
            'email' => 'police@admin.com',
            'type' => User::TYPE_ADMINISTRATOR,
            'password' => bcrypt('password'),
            'phone' => '09668862633'
        ]);

        $user->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
