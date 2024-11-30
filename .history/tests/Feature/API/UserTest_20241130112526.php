<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_fail()
    {
        $response = $this->post('/api/user/create', []);
        $response->assertStatus(302);
    }
    public function test_create_success()
    {
        $response = $this->post('/api/user/create', [
            'name' => 'Name',
            'email' => 'email@email.com',
            'password' => 'password'
        ]);
        $response->assertStatus(302);
    }
}
