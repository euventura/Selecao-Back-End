<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
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
        $response = $this->postJson('/api/user/create', [
            'name' => 'Name',
            'email' => 'email@email.com',
            'password' => 'password'
        ]);
        $response->assertSuccessful();
    }

    public function test_login_success()
    {
        $response = $this->postJson('/api/user/create', [
            'name' => 'Name',
            'email' => 'email@email.com',
            'password' => 'password'
        ]);

        $response = $this->postJson('/api/user/login', [
            'email' => 'email@email.com',
            'password' => 'password'
        ]);

        $response->assertJsonStructure(['token']);
    }

    public function test_login_fail()
    {

        $response = $this->postJson('/api/user/login', [
            'email' => 'email@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(401);
    }
    public function test_edit_success()
    {

        $response = $this->putJson('/api/user', [
            'email' => 'email@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(401);
    }
}
