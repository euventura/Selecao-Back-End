<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
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
    public function create(Request $request): Comment|Model
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = '1';

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
            'changed_at' => $comment->updated_at
        ];
        $comment->comment = $request->input('comment');
        $comment->history = array_merge($comment->history ?? [], [$addToHistory]);
        $comment->save();

        return $comment;
    }

    public function delete(Request $request, $commentId): JsonResponse
    {

        try {
            $comment = Comment::where('id', $commentId)->where('user_id', Auth::user()->id)->firstOrFail();
            $comment->delete();
            return response()->json('success');
        } catch (ModelNotFoundException $e) {
            return response()->json('Comment Not Found', 404);
        }
    }

    public function get(): array|Collection
    {
        return Comment::select('id', 'comment', 'created_at', 'updated_at')->get();
    }
}
