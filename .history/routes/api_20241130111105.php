<?php

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

Route::middleware('auth:sanctum')->get('/user/create', [UserController::class, 'create']);


Route::middleware('auth:sanctum')->get('/comments', function (Request $request) {
    return $request->user();
});

Route::post('/{productId}/comments', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->delete('/{productId}/comments/{commentId}', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->put('/{productId}/comments/{commentId}', function (Request $request) {
    return $request->user();
});
