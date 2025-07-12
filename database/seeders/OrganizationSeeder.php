<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
            'name' => 'Centralized Cloud Computing International Inc.',
            'description' => 'We are Enablers of Automation, We Deliver Simple, Modern and Sustainable Digital Experiences.',
            'status' => 'ACTIVE'
        ]);
    }
}
