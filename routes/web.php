<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('home', [
		"posts" => Post::whereIn('user_id', [5, 9])
					 ->orderBy('created_at', 'desc')
					 ->limit(10)
					 ->get()
	]);
})->name('home');

Route::get('/posts/{post}', function (Post $post) {
	return view('post.show', [
		"post" => $post
	]);
})->name('post.show');