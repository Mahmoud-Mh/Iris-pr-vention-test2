<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Registration Routes
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Login Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Logout Route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [AuthController::class, 'showPasswordResetForm'])->name('password.reset');
Route::post('password/email', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showPasswordResetPage'])->name('password.showResetPage');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Home Route (only accessible after login)
Route::middleware('auth')->get('/home', [HomeController::class, 'index'])->name('home');

// Post Routes (only accessible after login)
Route::middleware('auth')->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/delete/{post}', [PostController::class, 'destroy'])->name('post.delete');
});

Route::get('/', function () {
    return view('welcome');
});
