<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create new User
     * @param \Illuminate\Http\Request $request
     * @param mixed $productId
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model
     */
    public function create(UserCreateRequest $request): User|Model
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    /**
     * Update a User
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model
     */
    public function update(Request $request): User|Model
    {
        $user = $request->user();
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return $user;
    }
    /**
     * Login Method
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $token = $request->user()->createToken($request->user()->email);
            return ['token' => $token->plainTextToken];
        }

        return response()->json('Invalid credentials')->setStatusCode(401);
    }
}
