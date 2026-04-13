<?php

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

require __DIR__.'/auth.php';
