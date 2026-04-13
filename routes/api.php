<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:web');

// Note: Chat and Forum API routes are in routes/web.php for proper session support
// This file contains only token-based or public API routes

