<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Discount;
use App\Models\Terminal;
use App\Models\Trip;
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

        // client user

        $client = User::create([
            'name'=>'client user',
            'email'=>'client@user.com',
            'password'=> bcrypt('password')
        ]);

        // discount
        Discount::create([
            'description' => 'Student Discount',
            'rate' => '10',
        ]);

        info('Discount created!');


        //Terminal
        $t1 = Terminal::create([
            'name' => 'Terminal B',
            'address' => 'Address',
        ]);

        $t2 = Terminal::create([
            'name' => 'Terminal A',
            'address' => 'Address',
        ]);

        // trip
        $trip = Trip::create([
            'start' => $t1->name,
            'end' => $t2->name,
            'fare' => "250",
            'remarks' => 'sample remarks',
        ]);

        $user->assignRole($superadmin);
        info('Superadmin created!, email: super@admin.com');
    }
}
