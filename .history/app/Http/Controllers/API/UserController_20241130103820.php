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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        return $this->user->create($request->all());
    }

    public function update(Request $request): User|Model
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email'
        ]);

        $user = User::find(Auth::user()->id);

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
