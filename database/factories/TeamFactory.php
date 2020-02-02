<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'department_id' => \App\Department::all()->random()->id,
        'name' => ucwords($faker->catchPhrase)
    ];
});
