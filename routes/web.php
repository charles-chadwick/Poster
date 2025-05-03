<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});


Route::resource('posts', App\Http\Controllers\PostController::class)
	 ->only('index', 'create');

Route::resource('comments', App\Http\Controllers\CommentController::class)
	 ->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)
	 ->only('index', 'create');

Route::resource('comments', App\Http\Controllers\CommentController::class)
	 ->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)
	 ->only('index', 'create');

Route::resource('comments', App\Http\Controllers\CommentController::class)
	 ->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)
	 ->only('index', 'create');

Route::resource('comments', App\Http\Controllers\CommentController::class)
	 ->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->only('index', 'create');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->only('index', 'create', 'store');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->only('index', 'create', 'store');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->only('index', 'create', 'store');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->only('index', 'create', 'store');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'show', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('show');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->except('edit', 'destroy');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->except('edit', 'destroy');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->except('edit', 'destroy');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->except('edit', 'destroy');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->except('edit', 'destroy');
