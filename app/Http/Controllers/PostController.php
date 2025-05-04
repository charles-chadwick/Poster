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
		$posts = Post::where('user_id', 12)
					 ->orderBy('created_at')
					 ->limit(10)
					 ->get();

		return view('post.index', [
			'posts' => $posts,
		]);
	}

	public function show( Request $request, Post $post ) : View {
		return view('post.show', [
			'post' => $post,
		]);
	}

	public function create( Request $request ) : View {
		return view('post.form');
	}

	public function store( PostStoreRequest $request ) : RedirectResponse {
		$post_data = $request->validated();
		$post_data[ 'user_id' ] = auth()->user()->id;
		$post_data[ 'status' ] = PostStatus::Published;

		$post = Post::create($post_data);

		$request->session()
				->flash('post.title', $post->title);

		return redirect()->route('posts.show', [ 'post' => $post ]);
	}

	public function update( PostUpdateRequest $request, Post $post ) : RedirectResponse {
		$post->update($request->validated());

		$request->session()
				->flash('post.title', $post->title);

		return redirect()->route('post.show', [ 'post' => $post ]);
	}
}
