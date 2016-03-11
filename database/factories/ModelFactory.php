<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' 					=> $faker->name,
        'email' 				=> $faker->email,
        'password'			 	=> bcrypt(str_random(10)),
        'remember_token'		=> str_random(10),
    ];
});

$factory->define(App\Bus::class, function (Faker\Generator $faker) {
    return [
        'company_id'            => $faker->numberBetween(1, 10),
        'license_plate' 		=> $faker->numberBetween($min = 1000000, $max = 9000000),
        'bus_number' 			=> $faker->buildingNumber,
        'vehicle_number' 		=> $faker->swiftBicNumber,
        'model' 				=> 'BMW',
        'year' 					=> $faker->numberBetween($min = 1990, $max = 2016),
        'seats'                 => $faker->numberBetween($min = 20, $max = 50),
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' 					=> $faker->name,
        'year_founded' 			=> $faker->numberBetween($min = 1990, $max = 2016),
        'rating' 				=> $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        'verified' 				=> $faker->boolean($chanceOfGettingTrue = 50),
        'code'                  => $faker->stateAbbr,
    ];
});

$factory->define(App\Station::class, function (Faker\Generator $faker) {
    return [
        'company_id'            => $faker->numberBetween(1, 10),
        'name' 					=> $faker->name,
        'address' 				=> $faker->address,
    ];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {
    return [
        'price' 				=> $price = $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 100),
        'discount' 				=> $discount = $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 1),
        'final_price'           => $price * $discount,
    ];
});

$factory->define(App\Trip::class, function (Faker\Generator $faker) {
    return [
        'company_id'            => $faker->numberBetween(1, 10),
        'from' 					=> $from = $faker->numberBetween(1, 10),
        'to' 					=> $to = $faker->numberBetween(1, 10),
        'rating' 				=> $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        'depart_at' 			=> $faker->time($format = 'H:i:s', $max = 'now'),
        'arrive_at' 			=> $faker->time($format = 'H:i:s', $max = 'now'),
        'name'                  => App\Company::find($from)->name . ' to ' . App\Company::find($to)->name,
    ];
});


