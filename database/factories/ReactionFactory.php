<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Reaction;

class ReactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->regexify('[A-Za-z0-9]{25}'),
            'on' => fake()->word(),
            'on_id' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
