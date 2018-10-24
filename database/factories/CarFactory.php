<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Car::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));

    return [
        'make' => $faker->vehicleBrand,
        'model' => $faker->vehicleModel,
        'year' => $faker->biasedNumberBetween(1950, 2018, 'sqrt'),
    ];
});
