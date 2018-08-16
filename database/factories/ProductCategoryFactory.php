<?php

$factory->define(App\ProductCategory::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->name,
    ];
});
