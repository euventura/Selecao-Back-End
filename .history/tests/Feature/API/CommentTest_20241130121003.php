<?php

namespace Tests\Feature\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;


    public function test_create_success()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(
            '/api/1/comments',
            [
                'comment' => 'Comentário 1',
            ]
        );
        dd(Comment::get());
        $response->assertSuccessful();
    }
}
