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

        $response = $this->post(
            '/api/comment',
            [
                'comment' => 'Comentário 1',
            ]
        )->withHeaders('authorization', 'bearer ' . $token->plainTextToken);

        $response->dump();
    }
}
