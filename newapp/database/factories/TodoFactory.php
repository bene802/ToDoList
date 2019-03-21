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

$factory->define(App\Todo::class, function (Faker $faker) {
    $r = rand(1,3);
    $status = $r != 1 ? "pending" : "complete";
    return [
        'task' => $faker->name,
        'status' => $status,
    ];
});
