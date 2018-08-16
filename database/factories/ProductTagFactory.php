<?php

$factory->define(App\ProductTag::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
