<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment) {}
    public function create(Request $request) {}
}
