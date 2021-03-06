<?php

/** @var Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'task' => $faker->sentence,
        'is_done' => $faker->boolean,
        'is_deleted' => $faker->boolean,
        'created_at' => $faker->dateTime
    ];
});
