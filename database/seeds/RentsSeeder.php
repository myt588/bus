<?php

use Illuminate\Database\Seeder;

class RentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(App\Transaction::class, 20)->create();
        foreach(range(1, 20) as $index)
        {
            DB::table('rents')->insert([
                'user_id'               => 3,
		        'rental_id'             => $faker->numberBetween(1, 20),
		        'transaction_id'        => $faker->numberBetween(2, 20),
		        'start'                 => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
		        'end'                   => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
		        'created_at'            => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
            ]);
        }
    }
}
