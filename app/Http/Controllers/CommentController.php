<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller {

	public function index( Request $request ) : View {
		$comments = Comment::where('post_id', $request->get('post_id'))
						   ->orderBy('created_at')
						   ->limit(10)
						   ->get();

		return view('comment.index', [
			'comments' => $comments,
		]);
	}

	/**
	 * @param  Request  $request
	 * @param  Comment  $comment
	 * @return View
	 */
	public function show( Request $request, Comment $comment ) : View {
		return view('comment.show', [
			'comment' => $comment
		]);
	}

	/**
	 * @param  Request  $request
	 * @return View
	 */
	public function create( Request $request ) : View {
		return view('comment.create');
	}

	/**
	 * @param  CommentStoreRequest  $request
	 * @return RedirectResponse
	 */
	public function store( CommentStoreRequest $request ) : RedirectResponse {
		$comment = Comment::create($request->validated());

		return redirect()->route('post.show', [ 'post' => $comment->post ]);
	}

	/**
	 * @param  CommentUpdateRequest  $request
	 * @param  Comment  $comment
	 * @return RedirectResponse
	 */
	public function update( CommentUpdateRequest $request, Comment $comment ) : RedirectResponse {
		$comment->save();

		return redirect()->route('post.show', [ 'post' => $comment->post ]);
	}
}
