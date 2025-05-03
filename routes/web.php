<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('app');
});


Route::resource('posts', App\Http\Controllers\PostController::class);

Route::resource('comments', App\Http\Controllers\CommentController::class);

