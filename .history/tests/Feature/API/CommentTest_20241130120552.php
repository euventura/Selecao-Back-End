<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_success()
    {
        $response = $this->post('/api/user/create', [
            'name' => 'Name',
            'email' => 'email@email.com',
            'password' => 'password'
        ]);
        $response->assertSuccessful();
    }

    public function test_login_success()
    {
        $response = $this->post('/api/user/create', [
            'name' => 'Name',
            'email' => 'email@email.com',
            'password' => 'password'
        ]);

        $response = $this->post('/api/user/login', [
            'email' => 'email@email.com',
            'password' => 'password'
        ]);

        $response->assertJsonStructure(['token']);
    }

    public function test_login_fail()
    {

        $response = $this->post('/api/user/login', [
            'email' => 'email@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(401);
    }
}
