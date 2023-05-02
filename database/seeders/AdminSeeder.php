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
            'name' => 'admin',
            'email' => 'admin@erp.com',
            'password' => bcrypt('password'),
            'type' => User::TYPE_ADMIN,
        ]);

        $user->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
