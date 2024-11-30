<?php

namespace Tests\Feature\API;

use App\Models\User;
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
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user->createToken('test')->plainTextToken
        ])->putJson('/api/user', [
            'email' => 'email2@email.com',
            'password' => 'password2'
        ]);
        $response->dump();
        $response->assertSuccessful();
    }
}
