<?php

use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1, 200) as $index)
        {
            DB::table('tickets')->insert([
                'user_id'               => 6,
        		'trip_id'               => $faker->numberBetween(1, 2),
        		'transaction_id'        => $faker->numberBetween(1, 2),
        		'description'           => $faker->name,
                'created_at'            => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
        		'depart_date'			=> $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days')
            ]);
        }
    }
}
