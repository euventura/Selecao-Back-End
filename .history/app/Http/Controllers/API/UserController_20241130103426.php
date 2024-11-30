<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $comment;

    /**
     * Method __construct
     * @param \App\Models\User $comment
     */
    public function __construct(User $comment)
    {
        $this->user = $user;
    }
    public function create(Request $request, $productId): Comment|Model
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $productId;
        $data['history'] = [];

        return $this->comment->create($data);
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
