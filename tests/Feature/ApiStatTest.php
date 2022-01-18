<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiStatTest extends TestCase
{
   /** @test */
   public function it_retrieved_the_users_work_stats()
   {
       $user = User::first();
      $this->actingAs($user)
        ->get('/api/stats')
        ->assertSuccessful()
        ->dump();
   }
}
