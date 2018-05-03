<?php

use Illuminate\Database\Seeder;
use App\Appointment;
use App\Resource;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$now = new Carbon();

		for ($i=0; $i < 5; $i++) { 
			
			$randoResource = Resource::inRandomOrder()->first();

			$start = (clone $now)->hour(rand(5, 20))->minute(0)->second(0);

			$end = (clone $start)->addMinutes(rand(1,6) * 30);

			$faker = Faker\Factory::create();

			Appointment::create([
				'title' => $faker->name,
				'description' => $faker->sentence,
				'start' => $start,
				'end' => $end,
				'resource_id' => $randoResource->id
			]);

		}

	}
}