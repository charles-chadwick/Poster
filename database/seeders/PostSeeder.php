<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run() : void {

		DB::table("posts")
		  ->delete();
		$character_lines = DatabaseSeeder::getCharacterLines();

		foreach ( User::get() as $user ) {

			Post::factory(rand(1, 25))
				->sequence(function ( $sequence ) use ( $character_lines, $user ) {

					$random_status = rand(1, 25);
					$created_at = fake()->dateTimeBetween($user->created_at, "-1 day");
					return [
						'user_id'    => $user->id,
						'status'     => match ( true ) {
							$random_status <= 5                        => PostStatus::Draft,
							$random_status >= 6 && $random_status <= 8 => PostStatus::Removed,
							default                                    => PostStatus::Published
						},
						'content'    => function () use ( $character_lines, $user ) {
							// get the notes
							$dialogue_key = str_replace(' ', '_', strtolower($user->first_name.'_'.$user->last_name));
							if ( array_key_exists($dialogue_key, $character_lines) ) {
								return Arr::random($character_lines[ $dialogue_key ]);
							}
							else {
								return Arr::random(Arr::random($character_lines));
							}
						},
						'created_at' => $created_at,
						'updated_at' => $created_at,
					];
				})
				->create();
		}
	}

}
