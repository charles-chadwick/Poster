<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller {
	public function index( Request $request ) : View {
		$comments = Comment::where('post_id', $post_id)
						   ->orderBy('created_at,desc')
						   ->limit(10)
						   ->get();

		return view('comment.index', [
			'comments' => $comments,
		]);
	}

	public function show( Request $request, Comment $comment ) : View {
		return view('comment.show', [
			'comment' => $comment,
			'post'    => $post,
		]);
	}

	public function create( Request $request ) : View {
		return view('comment.create');
	}

	public function store( CommentStoreRequest $request ) : RedirectResponse {
		$comment = Comment::create($request->validated());

		return redirect()->route('post.show', [ 'post' => $post ]);
	}

	public function update( CommentUpdateRequest $request, Comment $comment ) : RedirectResponse {
		$comment->save();

		return redirect()->route('post.show', [ 'post' => $post ]);
	}
}
