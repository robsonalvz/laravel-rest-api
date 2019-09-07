<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'price'=> $faker-> randomFloat(2,0,8),
        'quantidade'=> $faker-> numberBetween(1, 20),
        'description'=> $faker-> text
    ];
});
