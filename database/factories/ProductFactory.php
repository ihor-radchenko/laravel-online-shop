<?php

use Faker\Generator as Faker;

$factory->define(AutoKit\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(3, 6), true),
        'price' => $faker->numberBetween(500, 1000000),
        'old_price' => rand(1, 5) > 3 ? $faker->numberBetween(100, 1000000) : null,
        'quantity' => $faker->numberBetween(0, 15),
        'is_top' => rand(1, 4) > 3 ? 1 : 0,
        'is_new' => rand(1, 4) > 3 ? 1 : 0,
        'img' => 'http://via.placeholder.com/800x500?text=Product+image',
        'description' => $faker->text(rand(50, 300)),
        'category_id' => $faker->numberBetween(1, 21),
        'brand_id' => $faker->numberBetween(1, 8),
        'weight' => $faker->randomFloat(3, 0.1, 50),
        'width' => $faker->randomFloat(2, 0.1, 5),
        'height' => $faker->randomFloat(2, 0.1, 5),
        'length' => $faker->randomFloat(2, 0.1, 5),
    ];
});
