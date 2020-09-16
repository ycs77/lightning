<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'content' => $faker->realText(1000),
        'visits' => $faker->numberBetween(10, 1000),
        'published' => $faker->boolean(80),
    ];
});
