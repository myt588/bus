<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city_state = DB::table('stations')->pluck('city', 'state');
        foreach( $city_state as $key => $value ) {
            DB::table('cities')->insert([
                'city_state' => $value .', '. $key
            ]);
        }
    }

}

