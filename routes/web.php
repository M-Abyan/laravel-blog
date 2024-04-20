<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\LikePostsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// posts
Route::get('/', [PostController::class, 'index'])->name('posts');
Route::get('/{user:username}/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// posts create
Route::get('/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/create', [PostController::class, 'store'])->middleware('auth')->name('posts.store');

// posts edit and delete
Route::get('/{user:username}/{post:slug}/edit', [PostController::class, 'edit'])->middleware('auth')->name('posts.edit');
Route::put('/{user:username}/{post}/edit', [PostController::class, 'update'])->middleware('auth')->name('posts.update');
Route::delete('/{user:username}/{post:slug}/delete', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');

// comments
Route::post('/{user:username}/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::post('/{user:username}/{post:slug}/{comment}/child', [CommentController::class, 'child'])->middleware('auth')->name('comments.child');
Route::post('/{user:username}/{post:slug}/{comment}/update', [CommentController::class, 'update'])->middleware('auth')->name('comments.update');
Route::delete('/{user:username}/{post:slug}/{comment}/delete', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.delete');

// like comments
Route::post('/{user:username}/{post:slug}/{comment}/like', [LikeCommentController::class, 'like'])->middleware('auth')->name('comments.like');

// likes post
Route::post('/{user:username}/{post:slug}/like', [LikePostsController::class, 'like'])->middleware('auth')->name('like');

// login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');



// register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');
