<?php

use Illuminate\Database\Seeder;
use App\ShipType;

class ShipTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipType::truncate();
	
		$faker = \Faker\Factory::create();
		
		for ($i = 0; $i < 3; $i++) {
			ShipType::create([
			'type' => $faker->word, 
			]);
		}
    }
}
