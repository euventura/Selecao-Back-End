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
    /**
     * Create new User
     * @param \Illuminate\Http\Request $request
     * @param mixed $productId
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request, $productId): User|Model
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        return $this->user->create($request->all());
    }

    /**
     * Update a User
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model
     */
    public function update(Request $request): User|Model
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email'
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->name;
        $user->save();

        return $user;
    }
}
