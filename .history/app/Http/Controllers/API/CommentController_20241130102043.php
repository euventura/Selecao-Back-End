<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $comment;

    /**
     * Method __construct
     * @param \App\Models\Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function create(Request $request, $productId)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $productId;

        return $this->comment->create($data);
    }

    public function update(Request $request, $commentId): Comment|Model
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::where('id', $commentId)->where('user_id', Auth::user()->id)->firstOrFail();
        $comment->comment = $request->input('comment');
        $comment->save();
        return $comment;
    }
}
