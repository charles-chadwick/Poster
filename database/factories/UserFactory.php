<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory {
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = User::class;

	/**
	 * Define the model's default state.
	 */
	public function definition() : array {
		$created_at = fake()->dateTimeBetween('-1 year', '-1 day');
		$random_status = rand(1, 25);

		return [
			'role'              => UserRole::User,
			'status'            => match(true) {
				$random_status <= 3 => UserStatus::Inactive,
				$random_status >= 3 && $random_status <= 6 => UserStatus::Banned,
				default => UserStatus::Active,
			},
			'first_name'        => fake()->firstName(),
			'last_name'         => fake()->lastName(),
			'email'             => fake()->safeEmail(),
			'email_verified_at' => $created_at,
			'created_at'        => $created_at,
			'updated_at'        => $created_at,
			'password'          => Hash::make('password'),
		];
	}
}
