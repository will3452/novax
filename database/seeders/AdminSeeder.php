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
            'name' => 'superadmin',
            'email' => 'super@admin.com',
            'type' => User::TYPE_ADMINISTRATOR,
            'password' => bcrypt('password'),
        ]);

        $user->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
