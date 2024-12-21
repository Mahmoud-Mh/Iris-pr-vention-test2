<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Default Home Route
Route::get('/', function () {
    return redirect('/login'); // Redirect to login by default
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Protected Routes (Only for Authenticated Users)
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Post Routes (CRUD)
    Route::resource('posts', PostController::class);

    // Liking Posts (Ensure you implement the like functionality in PostController)
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

    // Comment Routes (For adding comments to posts)
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');

    // Route to show a single post
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});
