<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts');

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [SessionsController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth', 'can:manage-posts'])->group(function () {
    Route::view('/admin', 'admin')->name('admin');
    Route::post('/generate', [PostController::class, 'generate'])->name('generate.post');
    Route::resource('posts', PostController::class)->only(['edit', 'update', 'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

    Route::get('/signup', [SignupController::class, 'create'])->name('signup');
    Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');
});

Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');
