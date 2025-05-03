<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table('users')->truncate();

		$path = database_path('src/characters.csv'); // Ensure the file is in the `database/seeders` directory

		if ( file_exists($path) ) {
			$file = fopen($path, 'r');
			fgetcsv($file); // Get the header row of the CSV

			while ( ( $row = fgetcsv($file) ) !== false ) {

				$row = collect($row)->map(function ( $item ) {
					return trim($item);
				});

				$first = $row[ 0 ];
				$middle = $row[ 1 ];
				$last = $row[ 2 ];
				$email = strtolower($first.'.'.str_replace(' ', '-', $last).'@example.com');

				User::factory()->create([
					'first_name'        => trim($first.' '.$middle),
					'last_name'         => $last,
					'email'             => $email,
				]);
			}

			fclose($file);
		}
    }
}
