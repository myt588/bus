<?php

use Illuminate\Database\Seeder; 

class StationTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
        foreach(range(1, 30) as $index)
        {
            DB::table('station_trip')->insert([
                'trip_id'	 => $faker->numberBetween(1, 50),
                'station_id' => $faker->numberBetween(1, 10),
                'time'		 => $faker->time,
            ]);
        }
    }
}
