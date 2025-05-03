<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'status' => fake()->regexify('[A-Za-z0-9]{25}'),
            'content' => fake()->paragraphs(3, true),
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
        ];
    }
}
