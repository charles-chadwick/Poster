<?php

namespace Database\Factories;

use App\Enums\CommentStatus;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentFactory extends Factory {
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Comment::class;

	/**
	 * Define the model's default state.
	 */
	public function definition() : array {
		$user = User::inRandomOrder()
					->first();
		$created_at = fake()->dateTimeBetween($user->created_at, '-1 day');
		return [
			'status'     => fake()->randomElement(CommentStatus::class),
			'content'    => fake()->paragraphs(3, true),
			'post_id'    => Post::inRandomOrder()
								->first()->id,
			'user_id'    => $user->id,
			'created_at' => $created_at,
			'updated_at' => $created_at,
		];
	}
}
