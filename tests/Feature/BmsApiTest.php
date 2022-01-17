<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

class BmsApiTest extends TestCase
{
    /** @test */
    public function it_create_bms()
    {
        $user = User::find(1);

        $payload = [
            'weight' => 45.6,
            'height' =>  132,
            'type' => 'bmi',
            'result' => 18,
        ];

        $response = $this->actingAs($user)
            ->json('post', '/api/bms', $payload)
            ->assertStatus(201);

            $response->dump();
    }

    /** @test */
    public function it_can_get_bms_records_via_api()
    {
        $user = User::find(1);

        $this->actingAs($user)
            ->json('get', '/api/bms', ['type' => 'bmi'])
            ->assertStatus(200)
            ->dump();
    }
}
