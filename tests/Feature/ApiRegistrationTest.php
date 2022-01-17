<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiRegistrationTest extends TestCase
{
    /** @test */
    public function it_register_user_through_api()
    {
      $data = [
          'username' => 'sample_user22',
          'password' => 'password132',
          'gender' => 'male',
          'birth_day' => now(),
          'name' => 'sample_user',
          'email' => 'sample@mail.com',
      ];

      $this->json('post', '/api/register', $data)
        ->assertStatus(200);
    }

    /** @test */
    public function it_let_users_login_through_api()
    {
        $payload = [
            'username' => 'sample_user22',
            'password' => 'password132',
        ];

        $this->json('post', '/api/login', $payload)
            ->assertStatus(200);
    }
}
