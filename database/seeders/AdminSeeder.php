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
            'name'=>'admin',
            'email'=>'admin@findie.com',
            'type' => "ADMIN",
            'password'=> bcrypt('password')
        ]);

        $user->assignRole($superadmin);
        info('admin created!, email: super@admin.com');
    }
}
