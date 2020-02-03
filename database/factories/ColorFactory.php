<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use \App\Color;
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

$factory->define(Color::class, function (Faker $faker, $attributes) {
    return [
        'sort' => $attributes,
        'color' => $faker->hexColor,
    ];
});
