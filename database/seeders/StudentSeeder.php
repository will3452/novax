<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'rommelamarilla18@gmail.com',
                'name' => 'rommel amarilla',
                'number' => rand(111111111111,999999999999),
                'level' => User::LEVEL[0],
                'strand' => User::STRAND[0],
                'type' => User::TYPE_STUDENT,
            ],
            [
                'email' => 'llaneta423@gmail.com',
                'name' => 'ila neta',
                'number' => rand(111111111111,999999999999),
                'level' => User::LEVEL[0],
                'strand' => User::STRAND[0],
                'type' => User::TYPE_STUDENT,
            ],
            [
                'email' => 'mica.jamon@gmail.com',
                'name' => 'mica jamon',
                'number' => rand(111111111111,999999999999),
                'level' => User::LEVEL[0],
                'strand' => User::STRAND[0],
                'type' => User::TYPE_STUDENT,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
