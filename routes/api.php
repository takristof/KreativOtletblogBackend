<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\LikesController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout']);
Route::post('save_user_info', [AuthController::class, 'saveUserInfo'])->middleware('jwtAuth');


Route::post('posts/create', [PostController::class, 'create'])->middleware('jwtAuth');
Route::post('posts/delete', [PostController::class, 'delete'])->middleware('jwtAuth');
Route::post('posts/update', [PostController::class, 'update'])->middleware('jwtAuth');
Route::get('posts', [PostController::class, 'posts'])->middleware('jwtAuth');
Route::get('posts/my_posts',[PostController::class, 'myPosts'])->middleware('jwtAuth');

Route::post('comments/create', [CommentsController::class, 'create'])->middleware('jwtAuth');
Route::post('comments/delete', [CommentsController::class, 'delete'])->middleware('jwtAuth');
Route::post('comments/update', [CommentsController::class, 'update'])->middleware('jwtAuth');
Route::post('posts/comments', [CommentsController::class, 'comments'])->middleware('jwtAuth');
Route::resource('posts', 'App\Http\Controllers\Api\PostController');

Route::post('posts/like', [LikesController::class, 'like'])->middleware('jwtAuth');

