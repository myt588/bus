<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('trips')->delete();
        // factory(App\Trip::class, 10)->create();

        // DB::table('transactions')->delete();
        factory(App\Transaction::class, 10)->create();

        $faker = Faker\Factory::create();
        foreach(range(1, 200) as $index)
        {
            DB::table('tickets')->insert([
                'user_id'               => 3,
        		'trip_id'               => $faker->numberBetween(1, 10),
        		'transaction_id'        => $faker->numberBetween(2, 20),
                'depart_station'        => $faker->numberBetween(1, 2),
                'arrive_station'        => $faker->numberBetween(1, 2),
        		'description'           => $faker->name,
                'created_at'            => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
        		'depart_date'			=> $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days')
            ]);
        }
    }
}
