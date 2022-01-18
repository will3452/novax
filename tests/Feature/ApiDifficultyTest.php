<?php

namespace Tests\Feature;

use App\Models\Module;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserModule;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiDifficultyTest extends TestCase
{
    /** @test */
    public function it_can_mark_as_done()
    {
        $user = User::find(1);
        //given
        $module = Module::first();

        //act
        $response = $this->actingAs($user)
            ->json('post', '/api/mark-as-done', ['module_id' => $module->id])
            ->assertStatus(200);

        $response->dump();
    }

    /** @test */
    public function it_gives_list_of_difficulties()
    {
      $this->get('/api/difficulties')
        ->assertSuccessful()
        ->dumpHeaders()
        ->dump();
    }

    /** @test */
    public function it_return_if_module_is_done()
    {
      $user = User::find(1);
      $module = Module::latest()->first();
      $this->actingAs($user)
        ->json('get', '/api/is-done', [
            'module_id' => $module->id,
        ])
        ->assertSuccessful()
        ->dump();
    }
}
