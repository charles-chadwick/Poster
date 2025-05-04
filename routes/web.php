<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::resource('/posts', PostController::class);
Route::resource('/comments', PostController::class);