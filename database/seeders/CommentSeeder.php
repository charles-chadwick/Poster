<?php

namespace Database\Seeders;

use App\Enums\CommentStatus;
use App\Enums\PostStatus;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table("comments")
		  ->delete();
		$character_lines = DatabaseSeeder::getCharacterLines();

		foreach ( Post::all() as $post ) {

			Comment::factory(rand(0, 10))
				->sequence(function ( $sequence ) use ( $character_lines, $post ) {

					$random_status = rand(1, 25);
					$created_at = fake()->dateTimeBetween($post->created_at, "-1 day");
					$users = User::inRandomOrder()->limit(rand(1, 50))->pluck('id');
					$users->add($post->user_id);
					return [
						'post_id' => $post->id,
						'user_id'    => fake()->randomElement($users),
						'status'     => match ( true ) {
							$random_status <= 5                        => CommentStatus::Draft,
							$random_status >= 6 && $random_status <= 8 => CommentStatus::Removed,
							default                                    => CommentStatus::Published
						},
						'content'    => function () use ( $character_lines, $post ) {
							// get the notes
							$dialogue_key = str_replace(' ', '_', strtolower($post->first_name.'_'.$post->last_name));
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
