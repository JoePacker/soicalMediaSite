<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'image' => 'https://picsum.photos/seed/' . $faker->randomNumber(5) . '/128',
        'bio' => $faker->realText(300),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
