<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consignment;
use Faker\Generator as Faker;

$factory->define(Consignment::class, function (Faker $faker) {
    return [
        'company_name' => $faker->name,
        'contact' => 123456789,
        'address_line1' => 'address 1',
        'address_line2' => 'address 2',
        'address_line3' => 'address 3',
        'city' => $faker->city,
        'country' => $faker->countryCode,
    ];
});
