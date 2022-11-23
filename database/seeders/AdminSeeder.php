<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\SMSCredit;
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
            'email'=>'super@admin.com',
            'password'=> bcrypt('password'),
            'profile_id' => null,
            'role' => 'ADMIN',
        ]);

        SMSCredit::create(['credit' => 500]);

        info('Superadmin created!, email: super@admin.com');
    }
}
