<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'team_id' => \App\Team::all()->random()->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'title' => $faker->jobTitle
    ];
});
