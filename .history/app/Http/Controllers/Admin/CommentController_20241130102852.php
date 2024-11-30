<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
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

    public function get($productId): array|Collection
    {
        return Comment::where('product_id', $productId)->get();
    }


    public function my($productId): array|Collection
    {
        return Comment::where('product_id', $productId)
            ->where('user_id', Auth::user()->id)
            ->get();
    }
}
