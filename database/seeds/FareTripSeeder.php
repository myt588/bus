<?php

use Illuminate\Database\Seeder;

class FareTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1, 50) as $index)
        {
            DB::table('fare_trip')->insert([
                'fare_id'	 => $faker->numberBetween(1, 10),
                'trip_id' 	 => $faker->unique()->numberBetween(1, 50),
            ]);
        }
    }
}