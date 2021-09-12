<?php

use App\Http\Controllers\Api\PostsController;
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

Route::get('posts', [PostsController::class, 'index']);
Route::get('posts/{post}', [PostsController::class, 'show']);
Route::post('posts', [PostsController::class, 'store']);
Route::put('posts/{post}', [PostsController::class, 'update']);
Route::delete('posts/{post}', [PostsController::class, 'destroy']);
