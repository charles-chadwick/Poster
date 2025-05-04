<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller {
	public function index( Request $request ) : View {
		$posts = Post::where('user_id', auth()->user()->id)
					 ->orderBy('created_at')
					 ->limit(10)
					 ->get();

		return view('posts.index', [
			'posts' => $posts,
		]);
	}

	public function show( Request $request, Post $post ) : View {
		return view('posts.show', [
			'post' => $post,
			'comments' => $post->comments()->orderBy('created_at')->get(),
		]);
	}

	public function create( Request $request ) : View {
		return view('posts.form');
	}

	public function store( PostStoreRequest $request ) : RedirectResponse {
		$post_data = $request->validated();
		$post_data[ 'user_id' ] = auth()->user()->id;
		$post_data[ 'status' ] = PostStatus::Published;

		$post = Post::create($post_data);

		$request->session()
				->flash('posts.title', $post->title);

		return redirect()->route('posts.show', [ 'posts' => $post ]);
	}

	public function edit( Post $post ) : View {
		return view('posts.form', [
			'post' => $post,
		]);
	}

	public function update( PostUpdateRequest $request, Post $post ) : RedirectResponse {
		$post->update($request->validated());

		$request->session()
				->flash('posts.title', $post->title);

		return redirect()->route('posts.show', [ 'posts' => $post ]);
	}
}
