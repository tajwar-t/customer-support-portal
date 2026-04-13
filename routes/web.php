<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AuthenticateApi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Chat and Forum pages
Route::middleware('auth')->group(function () {
    Route::get('/chat', function () {
        return view('chat.index');
    })->name('chat.index');

    Route::get('/chat/{id}', function ($id) {
        return view('chat.show', ['chatId' => $id]);
    })->name('chat.show');

    Route::get('/forum', function () {
        return view('forum.index');
    })->name('forum.index');

    Route::get('/forum/{slug}', function () {
        return view('forum.show');
    })->name('forum.show');

    Route::get('/forum/create', function () {
        return view('forum.create');
    })->name('forum.create');
});

// API routes with session authentication and JSON error responses
Route::prefix('api')->middleware(AuthenticateApi::class)->group(function () {
    // Chat API routes
    Route::get('/chats', [ChatController::class, 'index']);
    Route::post('/chats', [ChatController::class, 'store']);
    Route::get('/chats/{chat}', [ChatController::class, 'show']);
    Route::put('/chats/{chat}', [ChatController::class, 'update']);
    Route::put('/chats/{chat}/close', [ChatController::class, 'close']);
    Route::post('/chats/{chat}/messages', [ChatController::class, 'sendMessage']);
    Route::get('/chats/{chat}/messages', [ChatController::class, 'getMessages']);

    // Forum API routes
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/comments', [CommentController::class, 'getAllComments']);
        Route::put('/comments/{comment}/approve', [CommentController::class, 'approve']);
    });
});

// Public API routes (no auth required)
Route::prefix('api')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/featured', [PostController::class, 'getFeatured']);
    Route::get('/posts/category/{category}', [PostController::class, 'getByCategory']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
});

require __DIR__.'/auth.php';
