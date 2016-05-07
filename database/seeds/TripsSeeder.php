<?php

use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Trip::class, 10)->create()->each(function($r) {
            $faker = Faker\Factory::create();
            $r->bus()->associate(factory(App\Bus::class)->create());
            $r->stations()->save(App\Station::create([
                'company_id'    => $r->company_id,
                'city_id'       => $r->from,
                'name'          => 'Depart Station',
                'address'       => $faker->address,]), [
                'time'          => $r->depart_at, 
                'departure'     => true
                ]);
             $r->stations()->save(App\Station::create([
                'company_id'    => $r->company_id,
                'city_id'       => $r->to,
                'name'          => 'Depart Station',
                'address'       => $faker->address,]), [
                'time'          => $r->arrive_at, 
                'departure'     => false
                ]);
        });
        // DB::table('users')->delete();
        // factory(App\User::class, 10)->create();

        // DB::table('companies')->delete();
        // factory(App\Company::class, 10)->create();

        // DB::table('fares')->delete();
        // factory(App\Fare::class, 10)->create();

        // DB::table('buses')->delete();
        // factory(App\Bus::class, 30)->create();

        // DB::table('cities')->delete();
        // factory(App\City::class, 10)->create();

        // DB::table('stations')->delete();
        // factory(App\Station::class, 10)->create();

        // DB::table('trips')->delete();
        // factory(App\Trip::class, 50)->create();

        // DB::table('transactions')->delete();
        // factory(App\Transaction::class, 10)->create();

        // DB::table('tickets')->delete();
        // factory(App\Ticket::class, 10)->create();

        // DB::table('rentals')->delete();
        // factory(App\Rental::class, 10)->create();
    }
}
