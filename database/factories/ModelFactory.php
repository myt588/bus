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

$factory->define(App\Bus::class, function (Faker\Generator $faker) {
    return [
        'company_id'            => factory(App\Company::class)->create()->id,
        'license_plate' 		=> $faker->numberBetween($min = 1000000, $max = 9000000),
        'bus_number' 			=> $faker->buildingNumber,
        'vehicle_number' 		=> $faker->swiftBicNumber,
        'model' 				=> $faker->word,
        'make'                  => $faker->word,
        'year' 					=> $faker->numberBetween($min = 1990, $max = 2016),
        'seats'                 => $faker->numberBetween($min = 10, $max = 60),
        'type'                  => $faker->randomElement(['Minibus', 'Luxury Bus', 'Standard Bus', 'Electrical Bus']),
        'wifi'                  => $faker->boolean(50),
        'usb'                   => $faker->boolean(50),
        'toilet'                => $faker->boolean(50),
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' 					=> $faker->name,
        'year_founded' 			=> $faker->numberBetween($min = 1990, $max = 2016),
        'rating' 				=> $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        'verified' 				=> $faker->boolean($chanceOfGettingTrue = 50),
        'code'                  => $faker->stateAbbr,
        'base'                  => $faker->city. $faker->state,
        'policy'                => $faker->paragraph(10),
    ];
});

$factory->define(App\Station::class, function (Faker\Generator $faker) {
    return [
        'name' 					=> $faker->name,
        'address' 				=> $faker->streetAddress,
    ];
});

function getTo($from){
    $faker = Faker\Factory::create();
    $to = $faker->numberBetween(1, 10);
    if ($to == $from) {
        getTo($from);
    } else {
        return $to;
    }
}

$factory->define(App\Trip::class, function (Faker\Generator $faker) {
    return [
        'company_id'            => factory(App\Company::class)->create()->id,
        'from'                  => $from = 1,
        'to'                    => $to = 2,
        'bus_id'                => factory(App\Bus::class)->create()->id,
        'rating' 				=> $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        'depart_at' 			=> $faker->time($format = 'H:i A', $max = 'now'),
        'arrive_at' 			=> $faker->time($format = 'H:i A', $max = 'now'),
        'name'                  => App\City::find($from)->city . ', ' . App\City::find($from)->state . ' to ' . App\City::find($to)->city . ', ' . App\City::find($to)->state,
        'weekdays'              => 127,
        'price'                 => $price = $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 100),
        'discount'              => $discount = $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 1),
        'fee'                   => $price * $discount,
        'active'                => 1,
    ];
});

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {
    return [
        'user_id'               => 3,
        'company_id'            => $faker->numberBetween(1, 10),
        'booking_no'            => generateBookingNo('distinct', 8),
        'description'           => $faker->text,
    ];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {
    return [
        'description'           => $faker->text,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name'            => $faker->name,
        'last_name'             => $faker->name,
        'email'                 => $faker->email,
        'password'              => Hash::make("password"),
    ];
});

$factory->define(App\Rental::class, function (Faker\Generator $faker) {
    return [
        'company_id'            => factory(App\Company::class)->create()->id,
        'description'           => $faker->text,
        'per_hour'              => $faker->numberBetween(1, 10),
        'per_day'               => $faker->numberBetween(10, 50),
        'per_week'              => $faker->numberBetween(50, 100),
        'created_at'            => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
        'active'                => 1,
    ];
});

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        'city'                  => $faker->city,
        'state'                 => $faker->stateAbbr,
        'zipcode'               => $faker->postcode,
    ];
});

$factory->define(App\Rent::class, function (Faker\Generator $faker) {
    return [
        'user_id'               => 3,
        'rental_id'             => 1,
        'transaction_id'        => 3,
        'start'                 => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
        'end'                   => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
        'created_at'            => $faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days'),
    ];
});


