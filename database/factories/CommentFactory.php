<?php

use Faker\Generator as Faker;

$factory->define(\AutoKit\Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(rand(10, 200)),
        'name' => $faker->name(),
        'email' => $faker->freeEmail,
        'article_id' => $faker->numberBetween(1, 3)
    ];
});
