<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobOffer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(AdminSeeder::class);

        // $jobs = JobOffer::factory()->count(50)->create();

        // // tags
        // $tags = [
        //     'programming',
        //     'designer',
        //     'art',
        //     'coding',
        //     'web',
        //     'android',
        // ];

        // foreach ($jobs as $job) {
        //     $times = random_int(0, count($tags));
        //     for ($i = 0; $i < $times; $i++) {
        //         $job->tags()->create([
        //             'description' => $tags[$i],
        //         ]);
        //     }
        // }
    }
}
