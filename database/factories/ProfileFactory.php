<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl(64, 64),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
