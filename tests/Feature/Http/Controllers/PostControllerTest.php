<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\PostController;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PostController
 */
final class PostControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('posts.index'));

        $response->assertOk();
        $response->assertViewIs('posts.index');
        $response->assertViewHas('posts');
    }


    #[Test]
    public function show_displays_view(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post));

        $response->assertOk();
        $response->assertViewIs('post.form');
        $response->assertViewHas('posts');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('posts.create'));

        $response->assertOk();
        $response->assertViewIs('posts.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            PostController::class,
            'store',
            PostStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $status = fake()->word();
        $content = fake()->paragraphs(3, true);
        $user = User::factory()->create();

        $response = $this->post(route('posts.store'), [
            'status' => $status,
            'content' => $content,
            'user_id' => $user->id,
        ]);

        $posts = Post::query()
            ->where('status', $status)
            ->where('content', $content)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $posts);
        $post = $posts->first();

        $response->assertRedirect(route('posts.index'));
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            PostController::class,
            'update',
            PostUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $post = Post::factory()->create();
        $status = fake()->word();
        $content = fake()->paragraphs(3, true);
        $user = User::factory()->create();

        $response = $this->put(route('posts.update', $post), [
            'status' => $status,
            'content' => $content,
            'user_id' => $user->id,
        ]);

        $post->refresh();

        $response->assertRedirect(route('posts.show', ['posts' => $post]));

        $this->assertEquals($status, $post->status);
        $this->assertEquals($content, $post->content);
        $this->assertEquals($user->id, $post->user_id);
    }
}
