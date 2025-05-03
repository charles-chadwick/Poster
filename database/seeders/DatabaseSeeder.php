<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 */
	public function run() : void {
		// ( new UserSeeder() )->run();
		// ( new PostSeeder() )->run();

	}

	public static function getCharacterLines() : array {
		$filePath = base_path('database/src/simpsons_dataset.csv');
		$data = [];

		if ( file_exists($filePath) && is_readable($filePath) ) {
			$file = fopen($filePath, 'r');

			while ( ( $line = fgetcsv($file, escape: '\\') ) !== false ) {
				// Skip blank lines
				if ( count($line) < 2 || empty(trim($line[ 0 ])) || empty(trim($line[ 1 ])) ) {
					continue;
				}

				$key = strtolower(str_replace(' ', '_', trim($line[ 0 ]))); // Generate the key
				$value = trim($line[ 1 ]);                                  // Generate the value

				if ( !array_key_exists($key, $data) ) {
					$data[ $key ] = [];
				}

				$data[ $key ][] = $value;
			}

			fclose($file);
		}

		return $data;
	}
}
