<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		$faker = Faker\Factory::create();

		DB::table('users')->insert([
			'name' => $faker->name,
			'email' => $faker->email,
			'password' => bcrypt('secret'),
		]);
	}
}
