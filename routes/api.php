<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::get('/blog-posts', [BlogPostController::class, "index"]);
    Route::post('/blog-post', [BlogPostController::class, "store"]);
    Route::put('/blog-post/{blog_post}', [BlogPostController::class, "update"]);
    Route::post('/blog-post/archive/{blog_post}', [BlogPostController::class, "destroy"]);
    Route::put('/blog-post/update-status/{blog_post}', [BlogPostController::class, "updateStatus"]);
});


Route::post('/login', [AuthController::class, "login"]);
Route::post('/register', [AuthController::class, "register"]);
Route::get('/blog-posts/published', [BlogPostController::class, "getPublishedPosts"]);
