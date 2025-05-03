<?php
/** @noinspection ALL */

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller {
	public function index( Request $request ) : View {
		$posts = Post::where('user_id', $user_id)
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
		return view('post.create');
	}

	public function store( PostStoreRequest $request ) : RedirectResponse {
		$post = Post::create($request->validated());

		return redirect()->route('post.index');
	}

	public function update( PostUpdateRequest $request, Post $post ) : RedirectResponse {
		$post->update($request->validated());

		return redirect()->route('post.show', [ 'post' => $post ]);
	}
}
