<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Palette;
use App\Color;
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

$factory->define(Palette::class, function (Faker $faker) {
    return [
        'url' => $faker->bothify('?????'),
        'ip' => $faker->ipv4,
    ];
});
