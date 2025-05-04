<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run() : void {

		Post::factory()
			->sequence(fn ($sequence) => [
				'user_id' => User::inRandomOrder()->first()->id,
				'status'  => PostStatus::Published,
				'content' => "Hi I'm a post.",
			])
			->create();

	}

}
