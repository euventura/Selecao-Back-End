<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', [UserController::class, 'create']);
Route::put('/user', [UserController::class, 'update'])->middleware('auth:sanctum');

Route::post('/user/login', [UserController::class, 'login']);


Route::get('/comment', [CommentController::class, 'get']);
Route::post('/comment', [CommentController::class, 'create'])->middleware('auth:sanctum');
Route::put('/comment/{commentId}', [CommentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/comment/{commentId}', [CommentController::class, 'delete'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->put('/{productId}/comments/{commentId}', function (Request $request) {
    return $request->user();
});
