<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AuthenticateApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(AuthenticateApi::class);

// Chat routes - Session-based authentication
Route::middleware(AuthenticateApi::class)->group(function () {
    // Chat management
    Route::get('/chats', [ChatController::class, 'index']);
    Route::post('/chats', [ChatController::class, 'store']);
    Route::get('/chats/{chat}', [ChatController::class, 'show']);
    Route::put('/chats/{chat}', [ChatController::class, 'update']);
    Route::put('/chats/{chat}/close', [ChatController::class, 'close']);

    // Messages
    Route::post('/chats/{chat}/messages', [ChatController::class, 'sendMessage']);
    Route::get('/chats/{chat}/messages', [ChatController::class, 'getMessages']);
});

// Forum - Posts routes
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/featured', [PostController::class, 'getFeatured']);
Route::get('/posts/category/{category}', [PostController::class, 'getByCategory']);
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::middleware(AuthenticateApi::class)->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});

// Forum - Comments routes
Route::get('/posts/{post}/comments', [CommentController::class, 'index']);

Route::middleware(AuthenticateApi::class)->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});

// Admin routes
Route::middleware([AuthenticateApi::class, 'admin'])->group(function () {
    Route::get('/comments', [CommentController::class, 'getAllComments']);
    Route::put('/comments/{comment}/approve', [CommentController::class, 'approve']);
});
