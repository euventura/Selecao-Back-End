<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;

    /**
     * Method __construct
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function create(Request $request, $productId): User|Model
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        return $this->user->create($request->all());
    }

    public function update(Request $request, $commentId): Comment|Model
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::where('id', $commentId)->where('user_id', Auth::user()->id)->firstOrFail();
        $addToHistory = [
            'comment' => $comment->comment,
            'changed_at' => $comment->updatedAt
        ];
        $comment->comment = $request->input('comment');
        $comment->history = $comment->history[] = $addToHistory;
        $comment->save();

        return $comment;
    }

    public function get($productId): array|Collection
    {
        return Comment::where('product_id', $productId)->get();
    }


    public function my($productId): array|Collection
    {
        return Comment::where('user_id', Auth::user()->id)
            ->get();
    }
}
