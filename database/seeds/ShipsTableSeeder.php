<?php
use Illuminate\Database\Seeder;
use App\Ship;

class ShipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ship::truncate();
	
		$faker = \Faker\Factory::create();
		
		for ($i = 0; $i < 50; $i++) {
			Ship::create([
			'ship_name' => $faker->name, 
			'ship_type_id' => $faker->numberBetween($min = 1, $max = 3), 
			'docking_slot_id' => $faker->numberBetween($min = 1, $max = 50), 
			'owner_name' => $faker->name, 
			'owner_contancts' => $faker->email, 
			'ship_arrival_date' => $faker->dateTimeThisCentury->format('Y-m-d'), 
			'ship_departure_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
			]);
		}
    }
}
