<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CommentController;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommentController
 */
final class CommentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $comments = Comment::factory()->count(3)->create();

        $response = $this->get(route('comments.index'));

        $response->assertOk();
        $response->assertViewIs('comment.index');
        $response->assertViewHas('comments');
    }


    #[Test]
    public function show_displays_view(): void
    {
        $comment = Comment::factory()->create();

        $response = $this->get(route('comments.show', $comment));

        $response->assertOk();
        $response->assertViewIs('comment.show');
        $response->assertViewHas('comment');
        $response->assertViewHas('post');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('comments.create'));

        $response->assertOk();
        $response->assertViewIs('comment.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            CommentController::class,
            'store',
            CommentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $status = fake()->word();
        $content = fake()->paragraphs(3, true);
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $response = $this->post(route('comments.store'), [
            'status' => $status,
            'content' => $content,
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        $comments = Comment::query()
            ->where('status', $status)
            ->where('content', $content)
            ->where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $comments);
        $comment = $comments->first();

        $response->assertRedirect(route('post.show', ['post' => $post]));
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            CommentController::class,
            'update',
            CommentUpdateRequest::class
        );
    }

    #[Test]
    public function update_saves_and_redirects(): void
    {
        $comment = Comment::factory()->create();
        $status = fake()->word();
        $content = fake()->paragraphs(3, true);
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('comments.update', $comment), [
            'status' => $status,
            'content' => $content,
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        $comments = Comment::query()
            ->where('status', $status)
            ->where('content', $content)
            ->where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $comments);
        $comment = $comments->first();

        $response->assertRedirect(route('post.show', ['post' => $post]));
    }
}
