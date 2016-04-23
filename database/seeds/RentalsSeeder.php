<?php

use Illuminate\Database\Seeder;
use App\Bus;

class RentalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Bus::class, 100)->create()->each(function($r) {
            $r->rental()->save(factory(App\Rental::class)->make());
        });
        // $faker = Faker\Factory::create();
        // foreach(range(1, 200) as $index)
        // {
        //     DB::table('rentals')->insert([
        // 		'bus_id'                => factory(App\Bus::class)->create(),
        // 		'company_id'        	=> 1,
        // 		'description'           => $faker->sentence,
        //         'created_at'            => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
        // 		'one_day'				=> $faker->numberBetween($min = 1000, $max = 2000),
        // 		'three_days'			=> $faker->numberBetween($min = 3000, $max = 4000),
        // 		'one_week'				=> $faker->numberBetween($min = 5000, $max = 6000)
        //     ]);
        // }
    }
}
