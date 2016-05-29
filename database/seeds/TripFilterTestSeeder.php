<?php

use Illuminate\Database\Seeder;

class TripFilterTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 10)->create()->each(function($company) {
        	$faker = Faker\Factory::create();
        	$trip = $company->trips()->save(App\Trip::create([
		        'from'                  => $from = 1,
		        'to'                    => $to = 2,
		        'bus_id'                => factory(App\Bus::class)->create()->id,
		        'rating' 				=> $faker->randomFloat($nbMaxDecimals = 1, $min = 4, $max = 5),
		        'depart_at' 			=> $faker->time($format = 'h:i A', $max = 'now'),
		        'arrive_at' 			=> $faker->time($format = 'h:i A', $max = 'now'),
		        'name'                  => App\City::find($from)->city . ', ' . App\City::find($from)->state . ' to ' . App\City::find($to)->city . ', ' . App\City::find($to)->state,
		        'weekdays'              => 127,
		        'price'                 => $price = $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 1000),
		        'discount'              => $discount = $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 1),
                'fee'                   => $price * $discount,
        		]));
        	$trip->stations()->save(App\Station::create([
                'company_id'    => $company->id,
                'city_id'       => $trip->from,
                'name'          => 'Depart Station',
                'address'       => $faker->address,]), [
                'time'          => $trip->depart_at, 
                'departure'     => true
                ]);
            $trip->stations()->save(App\Station::create([
                'company_id'    => $company->id,
                'city_id'       => $trip->to,
                'name'          => 'Arrive Station',
                'address'       => $faker->address,]), [
                'time'          => $trip->arrive_at, 
                'departure'     => false
                ]);
        });
    }
}
