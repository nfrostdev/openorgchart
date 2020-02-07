<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\Team;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'team_id' => rand(0, 3) ? Team::all()->random()->id : null,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'title' => $faker->jobTitle
    ];
});
