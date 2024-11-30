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
     * Admin Delete - userId by pass
     * @param mixed $commentId
     * @return bool
     */
    public function delete($commentId): bool
    {
        return Comment::where('id', $commentId)->delete();
    }
}
