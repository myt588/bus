<?php

use Illuminate\Database\Seeder;

class RentalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Bus::class, 20)->create()->each(function($r) {
            $r->rental()->save(factory(App\Rental::class)->make());
        });
        
        $faker = Faker\Factory::create();
        foreach(range(1, 10) as $index)
        {
            DB::table('rents')->insert([
                'user_id'               => 3,
                'rental_id'             => $faker->numberBetween(1, 20),
                'transaction_id'        => $faker->numberBetween(1, 10),
                'description'           => $faker->name,
                'start'                 => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
                'end'                   => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
                'created_at'            => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days')
            ]);
        }
    }
}
