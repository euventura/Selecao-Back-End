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
    public function create()
    {
        $response = $this->post('/user/create');
        dd($response);
        $response->assertStatus(200);
    }
}
