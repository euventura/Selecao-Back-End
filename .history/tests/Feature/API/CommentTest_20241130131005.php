<?php

namespace Tests\Feature\API;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;


    public function test_create_success()
    {

        $user = User::factory()->create();
        $token = $user->createToken('test');
        $response = $this->withHeaders(
            ['Authorization' => 'Bearer ' . $token->plainTextToken]
        )
            ->postJson(
                '/api/comment',
                [
                    'comment' => 'Comentário 1',
                ]
            );
        $response->assertSuccessful()->assertJsonStructure(['comment', 'user_id', 'product_id', 'id', 'created_at', 'updated_at']);
    }

    public function test_update_success()
    {

        $user = User::factory()->create();
        $comment = Comment::factory()->create();
        $token = $user->createToken('test');
        $response = $this->withHeaders(
            ['Authorization' => 'Bearer ' . $token->plainTextToken]
        )
            ->putJson(
                '/api/comment/' . $comment['id'],
                [
                    'comment' => 'editado',
                ]
            );
        $response = $this->withHeaders(
            ['Authorization' => 'Bearer ' . $token->plainTextToken]
        )
            ->putJson(
                '/api/comment/' . $comment['id'],
                [
                    'comment' => 'deitado',
                ]
            );
        $response->getContent();
        dd($response->getContent());
    }
}
