<?php

use Illuminate\Database\Seeder;
use App\DockSlots;

class DockslotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DockSlots::truncate();
	
		$faker = \Faker\Factory::create();
		
		for ($i = 0; $i < 20; $i++) {
			DockSlots::create([
			'is_empty' => true, 
			'price_per_day' => $faker->numberBetween($min = 1, $max = 50), 
			]);
		}
    }
}
