<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory {
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Post::class;

	/**
	 * Define the model's default state.
	 */
	public function definition() : array {
		$user = User::inRandomOrder()
					->first();
		$created_at = fake()->dateTimeBetween($user->created_at, '-1 day');

		return [
			'status'     => fake()->randomElement(PostStatus::class),
			'content'    => fake()->text(),
			'user_id'    => $user->id,
			'created_at' => $created_at,
			'updated_at' => $created_at,
		];
	}
}
