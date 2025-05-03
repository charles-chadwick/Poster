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
			->create([
				'status'  => PostStatus::Published,
				'content' => "Hi I'm a post.",
				'user_id' => User::where('status', 'Active')
								 ->inRandomOrder()
								 ->first()->id
			]);

	}

}
