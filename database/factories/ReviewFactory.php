<?php

use Faker\Generator as Faker;

$factory->define(AutoKit\Review::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(1, 5), true),
        'text' => $faker->text(rand(10, 200)),
        'rating' => $faker->numberBetween(1, 5),
        'name' => $faker->name(),
        'product_id' => $faker->numberBetween(1, 509)
    ];
});
